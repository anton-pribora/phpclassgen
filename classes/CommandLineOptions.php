<?php

class CommandLineOptions
{
	/**
	 * 
	 * @var CommandLineOption[]
	 */
	protected $allOptions = [];
	
	protected $shortOptions = [];
	
	protected $longOptions = [];
	
	protected $values = null;
	
	/**
	 * Создать новую опцию в списке опций. Больше опций богу опций!
	 * 
	 * @param string $shortName
	 * @param string $longName
	 * @param string $description
	 * @param string $hasValue
	 * @param string $requireValue
	 * @return CommandLineOption
	 */
	public function createOption($shortName = null, $longName = null, $description = null, $hasValue = null, $requireValue = null)
	{
		$option = new CommandLineOption();
		
		$option->setShortName($shortName);
		$option->setLongName($longName);
		$option->setDescription($description);
		$option->setHasValue($hasValue);
		$option->setRequireValue($requireValue);
		
		$this->addOption($option);
		
		return $option;
	}
	
	/**
	 * Добавить опцию в список
	 * 
	 * @param CommandLineOption $option
	 */
	public function addOption(CommandLineOption $option)
	{
		$this->allOptions[] = $option;
		
		if ( $option->hasShortName() )
			$this->shortOptions[ $option->getShortName() ] = $option;
		
		if ( $option->hasLongName() )
			$this->longOptions[ $option->getLongName() ] = $option;
	}
	
	/**
	 * Заполнение значений опций
	 * 
	 * @throws LogicException
	 */
	public function parseOptions()
	{
		$shortOptions = '';
		$longOptions  = [];
		
		foreach ( $this->allOptions as $option )
		{
			if ( $option->hasShortName() )
				$shortOptions .= $option->getShortOpt();
			
			if ( $option->hasLongName() )
				$longOptions[] = $option->getLongOpt();
		}
		
		$result = getopt($shortOptions, $longOptions);
		
		if ( $result )
		{
			foreach ( $result as $id => $value )
			{
				/* @var $option CommandLineOption */
				if ( isset($this->shortOptions[$id]) )
				{
					$option = $this->shortOptions[$id];
					$option->setValue( $option->isHasValue() ? $value : true );
				}
				elseif ( isset($this->longOptions[$id]) )
				{
					$option = $this->longOptions[$id];
					$option->setValue( $option->isHasValue() ? $value : true );
				}
				else 
				{
					// Ooops... Narnia
					// @todo Throw something heavy in developer
					throw new LogicException('Unexpected option id '. $id);
				}
			}
		}
	}

	/**
	 * Какой-никакой, а вывод на экран
	 * 
	 * @return string
	 */
	public function __toString()
	{
		$string = "Опции\n";
		
		foreach ( $this->allOptions as $option )
		{
			$string .= "   ". ((string) $option) ."\n";
		}
		
		return $string;
	}
}