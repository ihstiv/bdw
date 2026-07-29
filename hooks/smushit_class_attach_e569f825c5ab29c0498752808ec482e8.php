<?php
class smushit_class_attach extends class_attach
{
	public function processUpload() {
		$id = parent::processUpload();
		if(!$this->settings['smush_auto'] or $this->error or !$id) {
			return $id;
		}
		
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'core' ) . '/sources/classes/attach/class_smush.php', 'class_smush' );
		$class_smush = new $classToLoad( $this->registry );
		
		$smush = $class_smush->smushone($id);

		return $id;
    }
}