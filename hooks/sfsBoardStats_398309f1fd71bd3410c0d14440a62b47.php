class sfsBoardStats extends skin_boards(~id~) {
    
    public function boardIndexTemplate($lastvisit="", $stats=array(), $cat_data=array(), $show_side_blocks=true, $side_blocks=array()) {
        $sfs = $this->DB->buildAndFetch(array('select' => 'blockCount, statText', 'from' => 'sfs_settings'));
        $this->lang->words['online_at_once'] .= "<li class='clear'><span class='value'>".$sfs['blockCount']."</span>".$sfs['statText']."</li>";
        return parent::boardIndexTemplate($lastvisit, $stats, $cat_data, $show_side_blocks, $side_blocks);
    }
}