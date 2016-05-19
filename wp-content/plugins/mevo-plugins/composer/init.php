<?php
/**
 * Main Visual composer manager.
 * @var Vc_Manager - instance of composer management.
 */
global $vc_manager;
$vc_manager->setIsAsTheme();
$vc_manager->disableUpdater();
$vc_manager->setEditorDefaultPostTypes( array( 'page', 'portfolio' ) );
$vc_manager->frontendEditor()->disableInline();
$vc_manager->automapper()->setDisabled();