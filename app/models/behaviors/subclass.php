<?php  
/**  
 * The SubclassBehavior allows a model to act as a subclass of another model and 
 * allows the implementation of 'ISA' relationships in Entity-Relationship database models.    
 * Parameters are passed to this behavior class to define the parent model of the subclass 
 * This class was based on and inspired by Matthew Harris's ExtendableBehavior class 
 * which can be found at http://bakery.cakephp.org/articles/view/extendablebehavior  
 *  
 * @author         Eldon Bite <eldonbite@gmail.com>  
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License  
 */  
class SubclassBehavior extends ModelBehavior {  
    /**  
     * The parent model being extended by the current model  
     *  
     * @var Object  
     */  
    var $parentClass; 
      
    /**  
     * The name of the type column, default 'type'  
     *  
     * @var string  
     */  
    var $typeField; 
     
    /**  
     * Alias for the subclass/type model  
     *  
     * @var string  
     */  
    var $typeAlias; 
      
    /**  
     * Set up the behavior.  
     * Finds parent model and determines type field settings.  
     */  
    function setup(&$model, $config = array()) { 
        $this->settings  = am(array('typeField' => 'type', 'typeAlias' => $model->alias), $config); 
        $this->parentClass = $this->__getparentClass($this->settings['parentClass']); 
        $this->typeField = $this->settings['typeField']; 
        $this->typeAlias = $this->settings['typeAlias']; 
        // Bind model associations on the fly 
        foreach ($model->__associations as $assoc) { 
                foreach ($this->parentClass->$assoc as $key => $value) { 
                $model->bindModel(array($assoc => array($key))); 
                } 
        } 
    } 
      
    /**  
     * Filter query conditions with the correct `type' field condition.  
     */  
    function beforeFind(&$model, $queryData)  
    { 
        if (array_key_exists($this->typeField, $model->_schema) && $model->alias != $this->parentClass->alias) { 
            if (!isset($queryData['conditions'])) { 
                $queryData['conditions'] = array(); 
            } 
            if (is_string($queryData['conditions'])) { 
                if (strlen(trim($queryData['conditions']))) { 
                    $queryData['conditions'] = "({$queryData['conditions']}) AND "; 
                } 
                $queryData['conditions'] .= $model->alias.'.'.$this->typeField.' = '.$this->typeAlias; 
            } 
            elseif (is_array($queryData['conditions'])) {  
                if (!isset($queryData['conditions'][$model->alias.'.'.$this->typeField])) { 
                    $queryData['conditions'][$model->alias.'.'.$this->typeField] = array();  
                } 
                $queryData['conditions'][$model->alias.'.'.$this->typeField] = $this->typeAlias; 
            } 
              
        } 
        return $queryData; 
    } 
     
    /**  
     * Set the `type' field before saving the record.  
     */  
    function beforeSave(&$model)  
    {  
        if (array_key_exists($this->typeField, $model->_schema) && $model->alias != $this->parentClass) {  
            if (!isset($model->data[$model->alias])) {  
                $model->data[$model->alias] = array();  
            }  
            $model->data[$model->alias][$this->typeField] = $model->alias;  
        }  
        return true; 
    } 
      
    /**  
     * Get the parent model of the subclass.   
     *  
     * @param        string Parent model name 
     * @return    object Parent model  
     */  
    function __getparentClass($parentClass)  
    { 
        App::import('model', $parentClass); 
        return new $parentClass; 
    }  
}  
?>