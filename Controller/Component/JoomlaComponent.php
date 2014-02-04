<?php

App::uses('Component', 'Controller');

/**
 * Joomla Component
 *
 * @category Joomla.Component
 * @package  Croogo.Joomla.Component
 * @version  0.1
 * @author   Josue Santos <contato@josuesantos.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://josuesantos.net
 */

 class JoomlaComponent extends Component {
    
        public function startup(Controller $controller) {
            
            ClassRegistry::init('Jimport.JimportAppModel');
            
            $this->userJoomla = ClassRegistry::init('Jimport.JoomUser');
            $this->userCroogo = ClassRegistry::init('Users.User');
            
            $this->categoryJoomla = ClassRegistry::init('Jimport.JoomCategory');
            $this->sectionJoomla = ClassRegistry::init('Jimport.JoomSection');
            
            $this->vocabularyCroogo = ClassRegistry::init('Taxomony.Vocabulary');
            $this->taxomonyCroogo = ClassRegistry::init('Taxomony.Taxomony');
            $this->termCroogo = ClassRegistry::init('Taxomony.Term');
            
            $this->contentJoomla = ClassRegistry::init('Jimport.JoomContent');
            $this->nodeCroogo = ClassRegistry::init('Nodes.Node');
            
        }
        
        public function migrateUsers(){
            $migrated = 0;
            $usersJoomla = $this->userJoomla->find('All');
            
            foreach($usersJoomla as $user){
                $user = $this->userJoomla->extractUser($user);
                $data = $this->userCroogo->create($user);
                
                if($this->userCroogo->save($data)){
                    $migrated++;
                }
            }
            
            CakeLog::write('Jimport',sprintf('Migrated: %d user(s)', $migrated));
            return $migrated;            
        }
        
        public function migrateTaxonomies(){
            $migrated = 0;
            $sectionsJoomla = $this->sectionJoomla->find('All');
            
            foreach($sectionsJoomla as $section){
              $data = $this->excractTerm($section);
              $term = $this->saveTerm($data);
            }
            
        }
        
        public function migrateNode(){
            
        }
        
        private function excractTerm($term, $taxonomy = NULL){
              $data = array(
                         'title' => $term['title'],
                         'slug' => $term['alias'],
                         'Taxonomy' => array(
                            'parent_id' => $taxonomy
                         )
                         );
              return $data;
        }
        
        private function saveTerm($data){
              $category = $this->termCroogo->findBySlug($data['slug']);
              if(empty($category)){
                     $term = $this->termCroogo->create($data);
                     $termId = $this->termCroogo->saveAndGetId($term);
              }else{
                     $TermId = $category['Term']['id'];
              }
              
        }
 }