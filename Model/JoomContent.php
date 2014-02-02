<?php
/**
 * Content Model
 *
 * @category Content.Model
 * @package  Croogo.Content.Model
 * @version  0.1
 * @author   Josue Santos <contato@josuesantos.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://josuesantos.net
 */
class JoomContent extends JimportAppModel {
        
        public $useTable = 'content';
        
        public $belongsTo = array(
                            'JoomSection' => array(
                                'foreignKey' => 'sectionid'
                                ),
                            'JoomCategory' => array(
                                'foreignKey' => 'foreignKey'
                                )
                        );
        
        
}