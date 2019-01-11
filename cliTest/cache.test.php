<?php
use Carbon\Carbon;
use Cache;

// Запись нового элемента в кэш

Cache::put('key', 'value', $minutes);

// Использование объектов Carbon для установки времени жизни кэша

$expiresAt = Carbon::now()->addMinutes(10);

Cache::put('key', 'value', $expiresAt);     

// Запись элемента, если он не существует

Cache::add('key', 'value', $minutes);

// Метод add возвращает true, если производится запись элемента в кэш. Иначе, если элемент уже есть в кэше, возвращается false.
// Проверка существования элемента в кэше

if (Cache::has('key'))
{
    //
}


// Чтение элемента из кэша

$value = Cache::get('key');

// Чтение элемента или возвращение значения по умолчанию

$value = Cache::get('key', 'default');

$value = Cache::get('key', function() { return 'default'; });

// Запись элемента на постоянное хранение

Cache::forever('key', 'value');

// Иногда вам может понадобиться получить элемент из кэша или сохранить его там, если он не существует. Вы можете сделать это методом Cache::remember:

$value = Cache::remember('users', $minutes, function()
{
    return DB::table('users')->get();
});

// Вы также можете совместить remember и forever:

$value = Cache::rememberForever('users', function()
{
    return DB::table('users')->get();
});

// все кэшируемые данные сериализуются, поэтому вы можете хранить любые типы данных.
// Изъятие элемента из кэша

// Если понадобится получить элемент из кэша, а потом удалить его, можно воспользоваться методом pull:

$value = Cache::pull('key');

// Удаление элемента из кэша

Cache::forget('key');

// Доступ к определённому хранилищу

// Если вы используете несколько хранилищ для кэша (с одинаковыми или разными драйверами) - вы можете обратиться к конкретному хранилищу следующим образом:

$value = Cache::store('foo')->get('key');    

// Увеличение и уменьшение значений

// Все драйверы, кроме file и database, поддерживают операции инкремента и декремента.

// Увеличение числового значения:

Cache::increment('key');

Cache::increment('key', $amount);

// Уменьшение числового значения:

Cache::decrement('key');

Cache::decrement('key', $amount);

