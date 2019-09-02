<?php

/**
 * @return function weekToTab récupération la date pour tout la semaine*
 */
function weekToTab($week)
{
    $year = date("Y");
    $tab = [date("Y-m-d", strtotime("{$year}-W{$week}-1")),
        date("Y-m-d", strtotime("{$year}-W{$week}-2 ")),
        date("Y-m-d", strtotime("{$year}-W{$week}-3")),
        date("Y-m-d", strtotime("{$year}-W{$week}-4")),
        date("Y-m-d", strtotime("{$year}-W{$week}-5"))];

    return $tab;
}

function weekToTab1($week)
{
    $year = date("Y");
    $tab = [date("d-m-Y", strtotime("{$year}-W{$week}-1")),
        date("d-m-Y", strtotime("{$year}-W{$week}-5"))];
    return $tab;
}
?>