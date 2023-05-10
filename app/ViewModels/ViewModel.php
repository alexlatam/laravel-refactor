<?php

namespace App\ViewModels;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use ReflectionMethod;

/**
 * El objetivo de esta clase abstracta ViewModel es convertir una instancia de ViewModel en una matriz.
 * Cada ViewModel que se cree DEBE extender esta clase ViewModel.
 * Y cada ViewModel tendran sus propios metodos, los cuales seran llamados desde el metodo toArray() de esta clase.
 *
 * Esta clase implementa la interfaz Arrayable, lo cual obliga a implementar el metodo toArray().
 */
abstract class ViewModel implements Arrayable
{
    // Este metodo toArray() de la interfaz Arrayable se utiliza para convertir la instancia actual de ViewModel en una matriz.
    public function toArray(): array
    {
        /**
         * ReflectionClass obtiene una lista de todos los métodos disponibles en la instancia actual de ViewModel.
         * Todos los metodos de la clase que extiende de esta clase ViewModel seran considerados.
         * La función collect() crea una instancia de la colección de Laravel a partir de la matriz de métodos obtenida por ReflectionClass.
         * ReflectionClass retorna un array con los metodos de la clase que extiende de esta clase ViewModel.
         */
        return collect((new \ReflectionClass($this))->getMethods())
            // Metodo reject() de la colección de Laravel (collect)
            // Elimina los métodos __construct y toArray de la colección de métodos.
            ->reject(fn (ReflectionMethod $method) => in_array($method->getName(), ['__construct', 'toArray']) )
            // Metodo filter() de la colección de Laravel
            // Filtra solo los metodos publicos. Solo los metodos publicos seran considerados
            ->filter(fn (ReflectionMethod $method) => in_array('public', \Reflection::getModifierNames($method->getModifiers())))
            // Metodo mapWithKeys() de la colección de Laravel
            // Convierte la colección de métodos en una matriz asociativa donde la clave es el nombre del método formato snake_case  y el valor es el resultado de la ejecución del método.
            ->mapWithKeys(fn (ReflectionMethod $method) => [Str::snake($method->getName()) => $this->{$method->getName()}() ])
            // Este metodo toArray() de la colección de Laravel se utiliza para convertir la colección de métodos en una matriz.
            ->toArray();
    }
}
