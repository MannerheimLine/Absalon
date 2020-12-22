<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Domains;

/**
 * Создание постраничной навигации, в ее простейшем исполнении
 *
 * По расчетам за раз из БД будет вытаскиваться не более 50-100 записей, а значит, делать какую то сверх оптимизацию
 * смысла нет.
 * Поэтому получаю сразу весь результат по запросу и делю его на страницы средствами PHP.
 * В данном случае пагинация нужна не для оптимизации запросов к БД, а для удобного вывода пользователю.
 *
 * Class Paginator
 * @package Absalon\Application\PatientCard\Search\Domains
 */
class Paginator
{

    public static function paginate(array $cards, int $page, int $offset) : array
    {
        $start = $page*$offset - $offset;
        $pagesCount = (int) ceil(count($cards)/$offset);
        $paginatedCards = array_slice($cards, $start, $offset);
        /**
         * Проверка на первую и последнюю страницу
         */
        if ($pagesCount === 1){
            $pageOrder = 'Single';
        }elseif ($page === 1){
            $pageOrder = 'First';
        }
        elseif (count($paginatedCards) < $offset){
            $pageOrder = 'Last';
        }
        else{
            $pageOrder = 'Middle';
        }
        $paginatedData['Cards'] = $paginatedCards;
        $paginatedCards['PagesCount'] = $pagesCount;
        $paginatedCards['pageOrder'] = $pageOrder;
        return $paginatedCards;
    }
}