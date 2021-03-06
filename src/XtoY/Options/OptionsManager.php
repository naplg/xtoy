<?php
namespace XtoY\Options;

class OptionsManager
{

  protected $options,
            $required_options;

     public function __construct()
     {
       $this->options = array();
       $this->required_options = array();

     }

     public function configure()
     {
     }

     public function init($options)
     {
       if (!empty($this->required_options)) {
        foreach ($this->required_options as $name) {
          if (!isset($options[$name])) {
              throw new \Exception('Missing Option :'. $name);
          }

        }
       }

      $this->setOptions($options);
     }

     public function setOptions($options)
     {
        foreach ($options as $name=>$value) {
          $this->setOption($name,$value);

        }

     }

     public function getOptions()
     {
       return $this->options;

     }

     public function addOption($optionName, $defaultValue)
     {

       $this->options[$optionName] = $defaultValue;

     }

     public function addRequiredOption($optionName)
     {

       $this->required_options[] = $optionName;
       $this->addOption($optionName,'');

     }

     public function setOption($optionName, $value)
     {

       if (!array_key_exists($optionName,$this->options)) {
         throw new \Exception(sprintf('Set unknow Option "%s" Existing options are "%s" :', $optionName,implode('","',array_keys($this->options))));
       }
       $this->options[$optionName] = $value;

     }

     public function getOption($optionName)
     {
        if (!array_key_exists($optionName,$this->options)) {
           throw new \Exception(sprintf('Get unknow Option "%s" Existing options are "%s" :', $optionName,implode('","',array_keys($this->options))));
       }

      return  $this->options[$optionName];

     }

}
