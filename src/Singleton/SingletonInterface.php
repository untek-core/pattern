<?php

namespace Untek\Core\Pattern\Singleton;

/**
 * Паттерн "Singleton"
 * 
 * Возможность иметь только 1 экземпляр объекта
 */
interface SingletonInterface
{

    /**
     * Получить экземпляр класса
     * @return static экземпляр класса
     */
    public static function getInstance(): self;
}
