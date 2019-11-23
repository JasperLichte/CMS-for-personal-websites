<?php

namespace about_me;


class AboutMeHelper
{

    public static function buildInfoSection()
    {
        return <<<HTML
    <h3>Hi, my name is <span class="highlighted accent">Jasper</span></h3>
HTML;

    }

}