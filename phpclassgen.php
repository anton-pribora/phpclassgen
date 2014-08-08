#!/usr/bin/php
<?php

spl_autoload_register(function($class) {
	$file = __DIR__ .'/classes/'. strtr($class, '\\', '/') .'.php';
	
	if ( is_readable($file) )
		include $file;
});

$options = new CommandLineOptions();

$wsdlPath          = $options->createOption('w', 'wsdl', 'Путь к файлу WSDL', true, true);
$showWsdlStructure = $options->createOption(null, 'show-wsdl', 'Показать структуру WSDL файла');
$showXsd           = $options->createOption(null, 'show-xsd', 'Показать структуру XSD схемы');
$showXsdTypes      = $options->createOption('T', 'show-xsd-types', 'Показать список типов');
$showHelp          = $options->createOption('h', 'help', 'Показать справку');
$outputDirectory   = $options->createOption('d', 'output-dir', 'Папка, куда сохранять файлы, по умолчанию '. var_export(CbFile::$pathBase, true), true, true);
$extension         = $options->createOption('e', 'extension', 'Расширение для генерируемых файлов, по умолчанию '. var_export(CbFile::$pathExtension, true), true, true);
$namespace         = $options->createOption('n', 'namespace', 'Пространство имён для генерируемых классов (заменяет targetNamespace)', true, true);

$options->parseOptions();

if ( $showHelp->hasValue() )
{
	echo "Программа для генерирования классов PHP из WSDL файлов\n";
	echo "Использование\n";
	echo "  ". basename(__FILE__) ." [опции]\n";
	echo "\n";
	echo $options;
	echo "\n";
	echo "Пример использования\n";
	echo "   Сгенерировать классы из XSD типов, которые находятся в файле service.wdl\n";
	echo "      ". basename(__FILE__) ." --wsdl service.wsdl --directory /some/path --namespace My\\Name\n";
	echo "\n";
	echo "Автор\n";
	echo "  Антон Прибора <info@anton-pribora.ru>, 2014\n";
	exit(1);
}
elseif ( !$wsdlPath->hasValue() )
{
	echo "Неверный вызов программы, используйте --help для получения справки\n";
	exit(2);
}

try {
	$parser = new WsdlParser($wsdlPath->getValue());
}
catch (Exception $e)
{
	echo "Не удалось открыть WSDL-файл. По причине: ". $e->getMessage() ."\n";
	exit(3);
}

if ( $showWsdlStructure->getValue() )
{
	echo $parser;
	exit(0);
}

if ( $showXsdTypes->getValue() )
{
	foreach ( $parser->getDefinitions()->getTypes()->getAllTypes() as $type )
	{
		echo $type->getName() ."\n";
	}
}

if ( $showXsd->getValue() )
{
	foreach ( $parser->getDefinitions()->getTypes()->getSchemas() as $schema)
	{
		echo $schema;
	}
	
	exit(0);
}

if ( $outputDirectory->hasValue() )
{
	$directory = $outputDirectory->getValue();
	
	if ( !is_dir($directory) || !is_writable($directory) )
	{
		echo "Указанная папка не доступна для чтения\n";
		exit(5);
	}
	
	$builder = new CbXsdClassGen();
	
	if ( $namespace->hasValue() )
	{
		$builder->registerNamespace($parser->getDefinitions()->getTargetNamespace(), $namespace->getValue());
	}
	
	CbFile::$pathBase = realpath($directory) .'/';
	
	if ( $extension->hasValue() )
	{
		CbFile::$pathExtension = $extension->getValue();
	}
	
	CbUtil::$indent = "\t";
	
	foreach ( $parser->getDefinitions()->getTypes()->getAllTypes() as $type )
	{
		if ( $type instanceof XsdComplexType )
		{
			echo $type->getName() .' .. ';
			
			try {
				$class = $builder->createClass($type);
				$file = new CbFile($class);
				$fileName = CbFile::$pathBase . $class->getName() . CbFile::$pathExtension;
				file_put_contents($fileName, $file->__toString());
				echo "ok\n";
			}
			catch (Exception $e)
			{
				echo 'Ошибка: '. $e->getMessage() ."\n";
			}
		}
	}
}