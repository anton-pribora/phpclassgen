phpclassgen
===========

    Программа для генерирования классов PHP из WSDL файлов
    Использование
      phpclassgen.php [опции]
    
    Опции
       -w, --wsdl VALUE               Путь к файлу WSDL
       --show-wsdl                    Показать структуру WSDL файла
       --show-xsd                     Показать структуру XSD схемы
       -T, --show-xsd-types           Показать список типов
       -h, --help                     Показать справку (текущее значение true)
       -d, --output-dir VALUE         Папка, куда сохранять файлы, по умолчанию ''
       -e, --extension VALUE          Расширение для генерируемых файлов, по умолчанию '.php'
       -n, --namespace VALUE          Пространство имён для генерируемых классов (заменяет targetNamespace)
    
    Пример использования
       Сгенерировать классы из XSD типов, которые находятся в файле service.wdl
          phpclassgen.php --wsdl service.wsdl --directory /some/path --namespace My\Name
    
    Автор
      Антон Прибора <info@anton-pribora.ru>, 2014
