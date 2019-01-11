<?php
use Carbon\Carbon;

// Получение текущей даты и времени
$date = Carbon::now();

// Другой способ получения текущей даты:
$current = new Carbon();

// Получение текущей даты
$date = Carbon::today();

// Получение завтрашней даты.
$date = Carbon::tomorrow();

// Получить последнюю пятницу в этом месяце.
$date = Carbon::now()-3;
$lastFriday = new Carbon('last friday of '.$date);

// Создание даты из определенного количества аргументов:
Carbon::createFromDate($year, $month, $day, $tz);
// Или время:
Carbon::createFromTime($hour, $minute, $second, $tz);
// Или время и дату:
Carbon::create($year, $month, $day, $hour, $minute, $second, $tz);

// если один из этих параметров передать как null, то будет подставлено текущее значение.

// Добавляем 3 дня к текущей дате.
$current = Carbon::now();
$date = Carbon::now()->addDays(3);

// Добавляем один день
$date = Carbon::now()->addDay();

// Вычитаем один день
$date = Carbon::now()->subDay();

// Вычитаем три дня
$date = Carbon::now()->subDays(3);

// Добавляем 5 лет к текущей дате
$date = Carbon::now()->addYears(5);

// Добавляем один год
$date = Carbon::now()->addYear();

// Вычитаем один год
$date = Carbon::now()->subYear();

// Вычитаем пять лет
$date = Carbon::now()->subYears(5);

$date = Carbon::now()->addMonths(2);

$date = Carbon::now()->addMonth();

$date = Carbon::now()->subMonths(2);

$date = Carbon::now()->subMonth();

$date = Carbon::now()->addWeeks(3);

$date = Carbon::now()->addWeek();

$date = Carbon::now()->subWeeks(3);

$date = Carbon::now()->subWeek(3);

$current = Carbon::now();

$date = Carbon::now();

$date->addHours(10);

echo $current->diffInHours($date, false);


