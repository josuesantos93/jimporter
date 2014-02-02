<?php
/**
 * Section Model
 *
 * @category Section.Model
 * @package  Croogo.Section.Model
 * @version  0.1
 * @author   Josue Santos <contato@josuesantos.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://josuesantos.net
 */
class JoomSection extends JimportAppModel {
        
        public $useTable = 'sections';
        
        public $hasMany = array(
                        'JoomCategory' => array(
                            'foreignKey' => 'section',
                            'dependent' => TRUE
                            )        
                    );
        
}