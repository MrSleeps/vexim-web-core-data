<?php

namespace VEximweb\Core\Data\Models;

use Illuminate\Notifications\DatabaseNotification;

class VwDatabaseNotification extends DatabaseNotification
{
    // Allow renaming of notifications DB table
    protected $table = 'vw_notifications';
}