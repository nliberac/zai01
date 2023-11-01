<?php
require ('Category.php');
class Event {
    public static $no_events=0;
    private $id;
    private $name;
    private $start_date;
    private $end_date;
    private $description;
    private $visualization;
    private $category_id;

    public function __construct(
        $in_id,
        $in_name,
        $in_start_date,
        $in_end_date,
        $in_description,
        $in_visualization,
        $in_category_id
    ){
        $this->id=$in_id;
        $this->name=$in_name;
        $this->start_date=$in_start_date;
        $this->end_date=$in_end_date;
        $this->description=$in_description;
        $this->visualization=$in_visualization;
        $this->category_id=$in_category_id;
        self::$no_events++;
    }

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @param mixed $name 
	 * @return self
	 */
	public function setName($name): self {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStart_date() {
		return $this->start_date;
	}
	
	/**
	 * @param mixed $start_date 
	 * @return self
	 */
	public function setStart_date($start_date): self {
		$this->start_date = $start_date;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEnd_date() {
		return $this->end_date;
	}
	
	/**
	 * @param mixed $end_date 
	 * @return self
	 */
	public function setEnd_date($end_date): self {
		$this->end_date = $end_date;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * @param mixed $description 
	 * @return self
	 */
	public function setDescription($description): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getVisualization() {
		return $this->visualization;
	}
	
	/**
	 * @param mixed $visualization 
	 * @return self
	 */
	public function setVisualization($visualization): self {
		$this->visualization = $visualization;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCategory_id() {
		return $this->category_id;
	}
	
	/**
	 * @param mixed $category_id 
	 * @return self
	 */
	public function setCategory_id($category_id): self {
		$this->category_id = $category_id;
		return $this;
	}

    public function showEvent(){
        echo '<div class="container'.$this->getCategory_id().'"><h2>'.$this->getStart_date().'-'.$this->getEnd_date().'</h2><p>'.$this->getName().'<p>';
        echo $this->getDescription().'</p></div>';

    }

}
?>