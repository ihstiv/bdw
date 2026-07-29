<?php

if( \IPS\Db::i()->checkForTable( 'weddings_weddings' ) )
{
    \IPS\Db::i()->dropTable( 'weddings_weddings' );
}

if( \IPS\Db::i()->checkForColumn( 'core_members', 'wedding_event_id' ) )
{
    \IPS\Db::i()->dropColumn( 'core_members', 'wedding_event_id' );
}