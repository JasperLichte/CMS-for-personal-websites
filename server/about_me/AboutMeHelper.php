<?php

namespace about_me;


class AboutMeHelper
{

    public static function buildInfoSection()
    {
        return <<<HTML
    <h2>Hi, my name is <span class="highlighted accent">Jasper</span></h2>
HTML;

    }

}