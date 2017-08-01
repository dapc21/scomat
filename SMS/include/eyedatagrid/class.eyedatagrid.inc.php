<?php

  $ini_u = $_SESSION["ini_u"]; 
/**
 * EyeDataGrid
 * Provides datagrid control features
 *
 * that is available through the world-wide-web at the following URI:
 * LICENSE: This source file is subject to the BSD license
 * http://www.eyesis.ca/license.txt.  If you did not receive a copy of
 * the BSD License and are unable to obtain it through the web, please
 * send a note to mike@eyesis.ca so I can send you a copy immediately.
 *
 * @author     Micheal Frank <mike@eyesis.ca>
 * @copyright  2008 Eyesis
 * @license    http://www.eyesis.ca/license.txt  BSD License
 * @version    v1.1.6 12/3/2008 10:04:44 AM
 * @link       http://www.eyesis.ca/projects/datagrid.html
 */

class EyeDataGrid
{
	private $results_per_page = 20;
	private $column_count = 0; // Num of columns
	public $row_count = 0; // Number of rows
	private $hide_header = false; // Header visibility
	private $hide_footer = false; // Footer visibility
	private $hide_order = false; // Show ordering option
	private $show_checkboxes = false; // Show checkboxes
	private $allow_filters = false; // Allow filters or not
	private $row_select = false; // Enable row selection
	private $create_button = false; // Show create button
	private $reset_button = false; // Show reset grid button
	private $show_row_number = false; // Show row numbers
	private $hide_page_list = false; // Hide page list
	private $page = 1; // Current page
	private $primary = ''; // Tables primary key column
	private $query; // SQL query
	private $hidden = array(); // Hidden columns
	private $header = array(); // Header titles
	
	private $modo = 'HTML'; // para imprimir
	private $echo_t = ''; // para imprimir
	private $excel_e = array(); // para exportar a excel
	private $i_e=0; //indice de arreglo para excel
	private $sql_excel=''; //indice de arreglo para excel
	
	
	private $type = array(); // Column types
	private $controls = array(); // Row controls, std or custom
	private $order = false; // Current order
	private $filter = false; // Current filter
	private $limit = false; // Current limit
	private $_db, $result; // Database related
	private $select_fields = ''; // Field used to select
	private $select_where = ''; // Where clause
	private $select_table = ''; // Table to read
	private $image_path = ''; // Path to images
	private $divDataGrid = ''; // Path to images
	private $archivoDataGrid = ''; // Path to images
	
	private $consulta = ''; // Path to images
	private $clase= '';
	public $desde;
	public $hasta;


	 // Filename of required images
	public $sql_query='';
	public $sql_header='';
	public $img_edit = 'edit.png';
	public $img_vdatos = 'vdatos.png';
	public $img_rec = 'rec.png';
	public $img_asig = 'asig.png';
	public $img_save = 'save.png';
	public $img_visita = 'visita.png';
	public $img_print = 'print.png';
	public $img_finalizar = 'finalizar.png';
	public $img_delete = 'delete.png';
	public $img_create = 'create.png';
	public $img_reset = 'reset.png';
	
	public $sumatoria = 0.00;


	// Configuration constants
	const CUSCTRL_TEXT = 1;
	const CUSCTRL_IMAGE = 2;
	const STDCTRL_VDATOS = 12;
	const STDCTRL_EDIT = 3;
	const STDCTRL_ASIG= 7;
	const STDCTRL_REC= 8;
	const STDCTRL_VISITA = 12;
	const STDCTRL_SAVE = 9;
	const STDCTRL_PRINT = 6;
	const STDCTRL_FINALIZAR = 5;
	const STDCTRL_DELETE = 4;
	const TYPE_DATE = 1;
	const TYPE_IMAGE = 2;
	const TYPE_ONCLICK = 3;
	const TYPE_ARRAY = 4;
	const TYPE_DOLLAR = 5;
	const TYPE_HREF = 6;
	const TYPE_CHECK = 7;
	const TYPE_PERCENT = 8;
	const TYPE_CUSTOM = 9;
	const TYPE_FUNCTION = 10;
	const TYPE_MONTO = 11;
	const ORDER_DESC = 'DESC';
	const ORDER_ASC = 'ASC';


	// Default text
	const TXT_RESET = 'Reset Table';
	const TXT_NORESULTS = 'Ningun resultado encontrado!';

	/**
	* Constructor
	*
	* @param EyeMySQLAdap $_db The Eyesis MySQL Adapter class
	* @param string $image_path The path to datagrid images
	*/
	public function __construct(EyePostgresAdap $_db, $image_path = '')
	{
		$this->_db = $_db;

		if (empty($image_path))
			$this->image_path = 'include/eyedatagrid/images/';
		else
			$this->image_path = $image_path;

		$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 0; // Page number
		$order = (isset($_GET['order'])) ? $_GET['order'] : ''; // Order clause
		$filter = (isset($_GET['filter'])) ? $_GET['filter'] : ''; // Filter clause
		$this->modo = (isset($_GET['modo'])) ? $_GET['modo'] : 'HTML'; // modo clause
		$this->divDataGrid = (isset($_GET['divDataGrid'])) ? $_GET['divDataGrid'] : 'datagrid'; // modo clause
		
	//	$this->archivoDataGrid = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; // modo clause
		$dir=$_SERVER['REQUEST_URI'];
		$valor=explode("?useajax=true",$dir);
	//	echo "<br>$valor[0]<br>";
		$val=explode("/",$valor[0]);
		for($i=3;$i<count($val);$i++){
			//echo "/".$val[$i];
			if(count($val)-1!=$i){
				$this->archivoDataGrid = $this->archivoDataGrid.$val[$i]."/";
			}else{
				$this->archivoDataGrid = $this->archivoDataGrid.$val[$i];
			}
		}
		
		
		// Set the limit
		if (empty($page) or $page <= 0)
			$this->setLimit(0, $this->results_per_page);
		else
			$this->page = $page;

		// Set the order
		if ($order)
		{
			list($column, $order) = $this->parseInputCond($order);
			$this->setOrder($column, $order);
		}

		// Set the filter
		if ($filter)
		{
			list($column, $value) = $this->parseInputCond($filter);
			$this->setFilter($column, $value);
		}
	}
	public function getModo()
	{
		return $this->modo;
	}
	public function setClase($clase)
	{
		$this->clase = $clase;
	}
	public function consultas($consulta)
	{
		$this->consulta = $consulta;
	}
	/**
	* Hides page drop down selection and replaces it with text
	*
	* @param $hide Show or hide the page drop down
	*/
	public function hidePageSelectList($hide = true)
	{
		$this->hide_page_list = $hide;
	}

	/**
	 * Allow filters
	 *
	 * @param boolean $allow
	 */
	public function allowFilters($allow = true)
	{
		$this->allow_filters = $allow;
	}

	/**
	 * Hide order functionality
	 *
	 * @param boolean $hide
	 */
	public function hideOrder($hide = true)
	{
		$this->hide_order = $hide;
	}

	/**
	 * Show checkboxes on each row
	 *
	 * @param boolean $show
	 */
	public function showCheckboxes($show = true)
	{
		$this->show_checkboxes = $show;
	}

	/**
	 * Hide header row
	 *
	 * @param boolean $hide
	 */
	public function hideHeader($hide = true)
	{
		$this->hide_header = $hide;
	}

	/**
	 * Hide footer row
	 *
	 * @param boolean $hide
	 */
	public function hideFooter($hide = true)
	{
		$this->hide_footer = $hide;
	}

	/**
	 * Show reset control
	 *
	 * @param string $text Display caption
	 */
	public function showReset($text = self::TXT_RESET)
	{
		$this->reset_button = $text;
	}

	/**
	 * Show row numbers
	 *
	 * @param boolean $show
	 */
	public function showRowNumber($show = true)
	{
		$this->show_row_number = $show;
	}

	/**
	 * Set the SELECT query
	 *
	 * @param string $fields Feilds to fetch from table. * for all columns
	 * @param string $table Table to select from
	 * @param string $primay Optional primary key column
	 * @param string $where Optional where condition
	 */
	public function setQuery($fields, $table, $primary = '', $where = '')
	{
		$this->primary = trim($primary);

		$this->select_fields = $fields;
		$this->select_table = $table;
		$this->select_where = trim($where);
	}

	/**
	 * Set filter
	 *
	 * @param string $column Column to apply filter clause on
	 * @param string $value Value to compare to
	 */
	private function setFilter($column, $value)
	{
		$this->filter = array('Column' => $column,
							'Value' => $value);
	}

	/**
	 * Set order
	 *
	 * @param string $column Column to apply order clause on
	 * @param string $order Direction, use ORDER_* const
	 */
	public function setOrder($column, $order = self::ORDER_DESC)
	{
		
		$order = ($order == self::ORDER_DESC)
					? self::ORDER_DESC
					: self::ORDER_ASC;

		$this->order = array('Column' => $column,
							'Order' => $order);
		
	}

	/**
	* Hides a column
	*
	* @param string $column The column to be hidden
	*/
	public function hideColumn($column)
	{
		$this->hidden[] = $column;
	}

	/**
	* Change column header caption
	*
	* @param string $column The column name
	* @param string $header The new header caption
	*/
	public function setColumnHeader($column, $header)
	{
		$this->header[$column] = $header;
	}

	/**
	* Set a column type
	*
	* @param string $column The column to apply the type to
	* @param integer $type The type of column, use TYPE_* const
	* @param mixed $criteria Specific value to each column type
	* @param mixed $criteria_2 Second specific value to each column type
	*/
	public function setColumnType($column, $type, $criteria = '', $criteria_2 = '')
	{
		$this->type[$column] = array($type, $criteria, $criteria_2);
	}

	/**
	* Sets the maximum amount of rows per page
	*
	* @param integer $num Amount of rows per page
	*/
	public function setResultsPerPage($num)
	{
		
		if($this->modo=='EXCEL'){
			$num = 100000;
		}
		//echo $num;
		$this->results_per_page = (int) $num;
		$this->setLimit(0, (int) $num);
		
	}

	/**
	* Adds a standard control to a row
	*
	* @param integer $type The type of standard control, use STDCTRL_* const
	* @param string $action The action of the control (onclick code or href link)
	* @param integer $action_type The type of action, use TYPE_ONCLICK or TYPE_HREF
	*/
	public function addStandardControl($type, $action, $action_type = self::TYPE_ONCLICK)
	{
		$action = $this->parseLinkAction($action, $action_type);

		switch ($type)
		{
			case self::STDCTRL_VDATOS:
				$this->controls[] = '&nbsp;<a ' . $action . '><button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Ver Datos"><i class="fa fa-table"></i></button></a>';
				break;
			case self::STDCTRL_EDIT:
				$this->controls[] = '&nbsp;<a ' . $action . '><button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fa fa-pencil"></i></button></a>';
				break;
			case self::STDCTRL_REC:
				$this->controls[] = '&nbsp;<a ' . $action . '><button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Rechazar"><i class="fa fa-thumbs-o-down"></i></button></a>';
				break;
			case self::STDCTRL_ASIG:
				$this->controls[] = '&nbsp;<a ' . $action . '><button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="Asignar Falla"><i class="fa fa-bullhorn"></i></button></a>';
				break;
			case self::STDCTRL_VISITA:
				$this->controls[] = '&nbsp;<a ' . $action . '><button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Agregar Visita"><i class="fa fa-share-square-o"></i></button></a>';
				break;
			case self::STDCTRL_SAVE:
				$this->controls[] = '&nbsp;<a ' . $action . '><button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Guardar"><i class="fa fa-check"></i></button></a>';
				break;
			case self::STDCTRL_PRINT:
				$this->controls[] = '&nbsp;<a ' . $action . '><button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Imprimir"><i class="fa fa-print"></i></button></a>';
				break;
			case self::STDCTRL_FINALIZAR:
				$this->controls[] = '&nbsp;<a ' . $action . '><button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="Finalizar"><i class="fa fa-sign-out"></i></button></a>';
				break;
			case self::STDCTRL_DELETE:
				$this->controls[] = '&nbsp;<a ' . $action . '><button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash-o"></i></button></a>';
				break;
			default:
				// Invalid standard control
				break;
		}
	}

	/**
	* Adds a custom control to a row
	*
	* @param integer $type The type of custom control, use CUSCTRL_* const
	* @param string $action The action of the control (onclick code or href link)
	* @param integer $action_type The type of action, use TYPE_ONCLICK or TYPE_HREF
	* @param string $text The textual description of the control
	* @param string $image_path The location of the image if type is CUSCTRL_IMAGE
	*/
	public function addCustomControl($type = self::CUSCTRL_TEXT, $action, $action_type = self::TYPE_ONCLICK, $text, $image_src = '')
	{
		$action = $this->parseLinkAction($action, $action_type);

		switch ($type)
		{
			case self::CUSCTRL_IMAGE:
				$this->controls[] = '<a ' . $action . '><img src="' . $image_src . '" alt="' . $text . '" title="' . $text . '" class="tbl-control-image"></a>';
				break;
			default: // Default to text
				$this->controls[] = '<a ' . $action . '>' . $text . '</a>';
				break;
		}
	}

	/**
	* Adds a create control above the table
	*
	* @param string $action The action associated to the create (onclick code or href link)
	* @param integer $action_type The type of action, use TYPE_ONCLICK or TYPE_HREF
	* @param string $text The textual description of the create
	*/
	public function showCreateButton($action, $action_type = self::TYPE_ONCLICK, $text = 'New Record')
	{
		$action = $this->parseLinkAction($action, $action_type);

		$this->create_button = array('Action' => $action,
										'Text' => $text);
	}

	/**
	* Adds ability to select a entire row
	*
	* @param string $onclick The JS function to call when a row is clicked
	*/
	public function addRowSelect($onclick)
	{
		$this->row_select = $onclick;
	}

	/**
	* Data sanitization and control for filters and ordering
	*
	* @param string $in The value to be sanitized and parsed
	*/
	private function parseInputCond($in)
	{
		return @explode(':', ereg_replace("[\'\"\<\>\\]", '%', $in), 2);
	}

	/**
	* Replaces our variables place holders with values
	*
	* @param array $row The row associated array
	* @param string $act The string containing place holders to replace
	* @return string
	*/
	private function parseVariables(array $row, $act)
	{
		// The only way we get an array for $act is for parameters from a column type of function
		if (is_array($act))
		{
			// Loop through each passed param and replace variables where necessary
			foreach ($act as $key => $value)
				$act[$key] = $this->parseVariables($row, $value);

			return trim($act);
		}

		// %_P% is an alias for the primary key, replace it with the primary key
		if ($this->primary)
			$act = str_replace('%_P%', '%' . trim($this->primary) . '%', $act);

		preg_match_all("/%([A-Za-z0-9_ \-]*)%/", $act, $vars);

		foreach($vars[0] as $v)
			$act = str_replace($v, $row[str_replace('%', '', $v)], $act);

		return trim($act);
	}

	/**
	* Builds a link action
	*
	* @param string $action The action
	* @param integer $action_type The type of actions (onclick code or href link)
	* @return string
	*/
	private function parseLinkAction($action, $action_type)
	{
		if ($action_type == self::TYPE_ONCLICK)
			$action = 'href="javascript:;" onclick="' . $action . '"';
		else
			$action = 'href="' . $action . '"';

		return $action;
	}

	/**
	* Sets the limit by clause
	*
	* @param integer $low The minimum row number
	* @param integer $high The maximum row number
	*/
	private function setLimit($low, $high)
	{
		$this->limit = array('Low' => $low,
							'High' => $high);
	}

	/**
	* Checks to see if this is an ajax table
	*
	* @return boolean
	*/
	public static function isAjaxUsed()
	{
		if (!empty($_GET['useajax']) and $_GET['useajax'] == 'true')
			return true;

		return false;
	}

	/**
	* Creates the table header
	*
	*/
	private function buildHeader()
	{
		
		
		// If entire header is hidden, skip all together
		if ($this->hide_header)
			return;

		/*echo*/ echo '<thead><tr class="titulo-tabla">';

		// Get field names of result
		
		$headers = $this->_db->fieldNameArray($this->result);
		$this->column_count = count($headers);
		

		// Add a blank column if the row number is to be shown
		if ($this->show_row_number)
		{
			$this->column_count++;
			/*echo*/ echo '<th align="center"><a href="javascript:;" align="center"><strong align="center">&nbsp;Nº&nbsp;</strong></a></th>';
			
		}

		// Show checkboxes
		if ($this->show_checkboxes)
		{
			$this->column_count++;
			if($this->clase=="Pagos"){
				echo '<th class="tbl-header-check numeric" align="center" ><input type="checkbox" name="checkbox" onclick="tblToggleCheckAll();calcularMontoPago();"> <input  type="hidden" name="email" maxlength="40" size="10" value="" ></th>';
			}
			else if($this->clase=="grupo_ubicacion"){
				echo '<th class="tbl-header-check" align="center" ><input type="checkbox" name="checkbox_gu" onclick="tblToggleCheckAll_gu();"></th>';
			}
			else{
				echo '<th class="tbl-header-check" align="center" ><input type="checkbox" name="checkbox" onclick="tblToggleCheckAll()"></th>';
			}
		}
		
		$j_e=0;
		// Loop through each header and output it
		foreach ($headers as $t)
		{
			
			// Skip column if hidden
			if (in_array($t, $this->hidden))
			{
				$this->column_count--;
				continue;
			}

			// Check for header caption overrides
			if (array_key_exists($t, $this->header))
				$header = $this->header[$t];
			else
				$header = $t;

			
			
			$this->sql_header=$this->sql_header."$t;$header;";
			if ($this->hide_order){
				echo '<th>' . strtoupper($header); // Prevent the user from changing order
			}
			else {
				if ($this->order and $this->order['Column'] == $t)
					$order = ($this->order['Order'] == self::ORDER_ASC)
										? self::ORDER_DESC
										: self::ORDER_ASC;
				else
					$order = self::ORDER_ASC;

					echo '<th><a href="javascript:;" onclick="tblSetOrder(\'' . $t . '\', \'' . $order . '\',\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.'\')">' . strtoupper($header) . "</a>";

				// Show the user the order image if set
				if ($this->order and $this->order['Column'] == $t){
				
					if ($order == self::ORDER_DESC){
						echo '&nbsp;<i class="fa fa-caret-square-o-down"></i>';
					} else {
						echo '&nbsp;<i class="fa fa-caret-square-o-up"></i>';
					}
				}
			}

			// Add filters if allowed and only if the column type is not "special"
			if ($this->allow_filters and
				!in_array($this->type[$t][0], array(
									self::TYPE_ARRAY,
									self::TYPE_IMAGE,
									self::TYPE_FUNCTION,
									self::TYPE_DATE,
									self::TYPE_MONTO,
									self::TYPE_CHECK,
									self::TYPE_CUSTOM,
									self::TYPE_PERCENT
									)))
			{
				if ($this->filter['Column'] == $t and !empty($this->filter['Value']))
				{
					$filter_display = 'block';
					$filter_value = $this->filter['Value'];
				} else {
					$filter_display = 'none';
					$filter_value = '';
				}
				/*echo*/ echo ' <a href="javascript:;" onclick="tblShowHideFilter_sms(\'' . $t . '\',\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.' \')"> <i class="fa fa-search fa-rotate-90"></i></a><br><div class="tbl-filter-box" id="filter-'.$this->divDataGrid . $t . '" style="display:' . $filter_display . '; font: 8pt Arial;" ><input type="text" size="5" style="font: 8pt Arial;" id="filter-value-' .$this->divDataGrid. $t . '" value="'.$filter_value.'">&nbsp;<a href="javascript:;" onclick="tblSetFilter(\'' . $t . '\',\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.'\')">Filtrar</a></div>';
			}

			/*echo*/ echo '</th>';
		}

		// If we have controls, add a blank column
		if (count($this->controls) > 0)
		{
			$this->column_count++;
			/*echo*/ echo '<th class="numeric">&nbsp;</th>';
		}

		/*echo*/ echo '</tr></thead>';
		
		
		

	}

	/**
	* Creates the table footer
	*
	* @param integer $shown The amounts of rows being shown in the current page
	* @param integer $first The row number of the first row
	* @param integer $last The row number of the last row
	*/
	private function buildFooter($shown, $first = 0, $last = 0)
	{
		// Skip adding the footer if it is hidden
		if ($this->hide_footer)
			return;

		$pages = ceil($this->row_count / $this->results_per_page); // Total number of pages

		echo '<tfoot>
		<tr class="tbl-footer">
		<td class="total-tabla-dinamica" colspan="' . $this->column_count . '">';
				
		echo '
		<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="dataTables_paginate paging_bootstrap pagination">
		<ul>';
		if ($this->row_count > $this->results_per_page)
		{

			if ($this->page > 1){
				echo '
				<li class="prev">
				<a href="javascript:;" onclick="tblSetPage_sms(1,\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.'\')"><i class="fa fa-angle-double-left"></i></a>
				</li>
				<li class="prev">
				<a href="javascript:;" onclick="tblSetPage_sms(' . ($this->page - 1) . ',\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.'\')"><i class="fa fa-angle-left"></i></a>
				</li>';
			}
			else{
				echo '
				<li class="prev disabled">
				<a href="javascript:;"><i class="fa fa-angle-double-left"></i></a>
				</li>
				<li class="prev disabled">
				<a href="javascript:;"><i class="fa fa-angle-left"></i></a>
				</li>';
			}

			//-------------------------------------------
			$numPaginaControl = 2; //variable de control creada para manipular el nro de botones visibles. 
			// Special thanks to ionut for this next few lines
			$startpage = ($this->page > $numPaginaControl) ? $this->page - $numPaginaControl : 1;

			$endpage = (($pages - $numPaginaControl) > $this->page) ? $this->page + $numPaginaControl : $pages;

			// Only display a portion of the selectable pages
			for ($i = $startpage; $i <= $endpage; $i++)
			{
				if ($i == $this->page){						
					echo '
					<li class="active">
					<a href="#">' . $i . '</a>
					</li>';
				}
				else{
					echo '
					<li>
					<a href="javascript:;" onclick="tblSetPage_sms(' . $i . ',\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.'\')">' . $i . '</a>
					</li>';
				}
			}

			//-------------------------------------------
			if($this->page < $pages){
				echo '
				<li class="next">
				<a href="javascript:;" onclick="tblSetPage_sms(' . ($this->page + 1) . ',\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.'\')"><i class="fa fa-angle-right"></i></a>
				</li>
				<li class="next">
				<a href="javascript:;" onclick="tblSetPage_sms(' . $pages . ',\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.'\')"><i class="fa fa-angle-double-right"></i></a>
				</li>';
			}
			else{
				echo '
				<li class="next disabled">
				<a href="javascript:;"><i class="fa fa-angle-right"></i></a>
				</li>
				<li class="next disabled">
				<a href="javascript:;"><i class="fa fa-angle-double-right"></i></a>
				</li>';
			}

		}

		if ( $this->row_count == 1 ) $rango = '<i class="fa fa-table"></i> ' . 1 .' Registro';
		else if ( $this->row_count > 1 ) $rango = '<i class="fa fa-table"></i> ' . $first . ' <i class="fa fa-long-arrow-right"></i> ' . $last. ' de '. $this->row_count  .' Registros';
		else $rango = '<i class="fa fa-table"></i> ' . 0 .' Registros';
		
		
		echo '
		</ul>
		</div>
		</div>
		</div>';
		
		echo '
		<div class="row">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-inline pull-left">
		';
		
		echo '
			<div class="input-group">
			<span class="input-group-addon contenido-resultados"><i class="fa fa-list-ol"></i> </span>
			<input class="form-control resultados" type="text" style="width:75px;" maxlength="3" name="tblresul_'.$this->divDataGrid.'" id="tblresul_'.$this->divDataGrid.'" value="'.$this->results_per_page.'" onChange="tblSetResul(\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.'\')" >
			</div>
		
		<input type="hidden" name="tblresulTodo_'.$this->divDataGrid.'" id="tblresulTodo_'.$this->divDataGrid.'" maxlength="10" size="5" value="'.$this->row_count.'">';
		
		echo '
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<div class="form-inline pull-right">';
		
		echo '<label class="contenido-registros"><div class="dataTables_info">' . $rango . '</div></label>';
		echo '<button type="button" class="btn btn-success contenido-boton-excel" data-toggle="tooltip" data-placement="bottom" title="Exportar Datos a Excel" onclick=\'updateTableExcel_sms("'.$this->archivoDataGrid.'")\'><i class="fa fa-file-text"></i> </button>' . ' ';	
		echo '<button type="button" class="btn btn-info contenido-boton-todos" data-toggle="tooltip" data-placement="bottom" title="Mostrar Todos los Registros" onclick="tblSetResulTodo_sms(\''.$this->archivoDataGrid.'\',\''.$this->divDataGrid.'\')"><i class="glyphicon glyphicon-list"></i> </button>';
		echo '
		</div>
		</div>
		
		</div>
		
		</div>';
		

		echo '</td>';
		
		echo '</tr>';
		echo '</tfoot>';

	}

	/**
	* Builds row controls
	*
	* @param array $row The row associated array
	*/
	private function buildControls(array $row)
	{
			// Add controls as needed
			if (count($this->controls) > 0)
			{
				/*echo*/ echo '<td class="numeric">';
				foreach ($this->controls as $ctl)
					/*echo*/ echo $this->parseVariables($row, $ctl);
				/*echo*/ echo '</td>';
			}
	}

	/**
	* Outputs the datagrid to the screen
	*
	*/
	public function printTable()
	{
		$j_e=0;
		// Set the limit
		$this->setLimit(($this->page - 1) * $this->results_per_page, $this->results_per_page);

		// FILTER
		$filter_query = '';
		if ($this->select_where)
			$filter_query .= "(" . $this->select_where . ")";

		if($this->allow_filters and $this->filter)
		{
			
			$query = 'SELECT ' . $this->select_fields . ' FROM ' . $this->select_table;
			$this->result = $this->_db->query($query, false);
			$tipo = $this->_db->fieldTypeArray($this->result);
			$tipo_campo=strtolower(trim($tipo[$this->filter['Column']]));
		
			if($tipo_campo=="bpchar" || $tipo_campo=="char" || $tipo_campo=="varchar" || $tipo_campo=="text"){
				if (!strstr($this->filter['Value'], '%'))
					$filter_value = '%' . $this->filter['Value'] . '%';
				else
					$filter_value = $this->filter['Value'];

				if ($this->select_where)
					$filter_query = $filter_query . " AND ";
				
				$filter_query .= "(" . $this->filter['Column'] . " ILIKE '" . $filter_value . "')";
				
			}
			else{
				$filter_value = $this->filter['Value'];
				
				if ($this->select_where)
					$filter_query = $filter_query . " AND ";
				
				$filter_query .= "" . $this->filter['Column'] . " = '" . $filter_value . "'";
			}
		
		}
		
		if ($filter_query)
			$filter = 'WHERE ' . $filter_query;

		// ORDER
		if ($this->order)
			$order = "ORDER BY " . $this->order['Column'] . " " . $this->order['Order'];
		else
			$order = '';

		// LIMIT
		if ($this->limit)
			$limit = "LIMIT " . $this->limit['High'] . " offset " . $this->limit['Low'];
		else
			$limit = '';

		if($this->consulta!=''){
			$query = $this->consulta;
			
		}
		else{
			$query = 'SELECT ' . $this->select_fields . ' FROM ' . $this->select_table . ' ' . $filter;
			
		}
		//echo "$query";
		// Inform the user of any errors. Commonly caused when a column is specified in the filter or order clause that does not exist
		
		if($this->modo=="EXCEL"){
		
			//$this->result = $this->_db->query($query . ' ' . $order . ' LIMIT 1 offset 0 ', false);
			$this->sql_query=$query . ' ' . $order;
			
			
			
			require_once '../../include/PHPExcel/generaExcel.php';
			require_once("../DataBase/Acceso.php");
			$acceso=conexion();
			$obj=new generarExcel();
		
			//echo "<br>$this->sql_query:";
			$obj->generar_con_sql($acceso,$this->sql_query,$this->header);
			return;
			
		}
		
		//echo $query . ' ' . $order . ' ' . $limit;
		$this->result = $this->_db->query($query . ' ' . $order . ' ' . $limit, false);
		$this->sql_query=$query . ' ' . $order;
		
		if (!$this->result)
		{
			/*echo*/ echo '<div style="color: red; font-weight: bold; border: 2px solid red; padding: 10px;">Oops! We ran into a problem while trying to output the table. <a href="javascript:;" onclick="tblReset()">Click here</a> to reset the table or <a href="javascript:;" onclick="alerta(\'' . @ereg_replace('[\'"]', '', $this->_db->error()) . '\')">here</a> to review the error.</div>';
			return;
		}

		// Count the number of rows without the limit clause
		//$this->row_count = (int) $this->_db->selectOneValue('COUNT(*)', $this->select_table, $filter_query); // Old code which does not support large data sets: $this->_db->countRows($query);
		$this->row_count = (int) $this->_db->rows_count;

		if (!$this->isAjaxUsed())
		{
			// Print out required javascript functions
			$this->printJavascript();
			
		}

		/*echo*/ echo '';

		// Output the create button
		if ($this->create_button)
			/*echo*/ echo '<span class="tbl-create"><a ' . $this->create_button['Action'] . ' title="' . $this->create_button['Text'] . '"><img src="' . $this->image_path . $this->img_create . '" class="tbl-create-image">' . $this->create_button['Text'] . '</a></span>';

		// Output the reset button
		if ($this->reset_button)
			/*echo*/ echo '<span class="tbl-reset"><a href="javascript:;" onclick="tblReset_sms()" title="' . $this->reset_button .'"><img src="' . $this->image_path . $this->img_reset . '" class="tbl-reset-image">' . $this->reset_button .'</a></span>';

		echo '<table class="table table-hover table-condensed">';

		$this->buildHeader();

		/*echo*/ echo '<tbody>';

		if ($this->row_count == 0)
			echo '<tr><td colspan="' . $this->column_count . '" class="numeric">' . self::TXT_NORESULTS . '</td></tr>';
		else {
			$i = 0; $first = 0; $last = 0;
			
			$ca[0]='';
			$y=0;
			if($this->clase=="rep_libroventa"){
							require_once("../DataBase/Acceso.php");
							$acceso=conexion();	
							$acceso->objeto->ejecutarSql("SELECT * FROM parametros where id_param='2'");
							if($fila=$acceso->objeto->devolverRegistro())
							{
								$por_iva=trim($fila['valor_param']);
							}
			}
					  
			while ($row = $this->_db->fetchAssoc($this->result))
			{
				$j_e=0;
					
					if($this->clase=="DetalleCobros"){
						$x=0;
						for($j=0;$j<count($ca);$j++){
							if($ca[$j]==trim($row["nro_factura"])){
								$x=1;
							}
						}
						if($x==0){
							$ca[$y]=trim($row["nro_factura"]);
							$y++;
						}
						else{
							continue;
						}
					}
					if($this->clase=="rep_libroventa"){
						$x=0;
						for($j=0;$j<count($ca);$j++){
							if($ca[$j]==trim($row["nro_factura"])){
								$x=1;
							}
						}
						if($x==0){
							$ca[$y]=trim($row["nro_factura"]);
							$y++;
						}
						else{
							continue;
						}
					}
					
					if($this->clase=="status_contrato"){
					
					}
					
					
				/*echo*/ echo '<tr class="tbl-row tbl-row-' . (($i % 2) ? 'odd' : 'even'); // Switch up the bgcolors on each row

				// Handle row selects
				if ($this->row_select)
					/*echo*/ echo ' tbl-row-highlight" onclick="' . $this->parseVariables($row, $this->row_select);

				/*echo*/ echo '">';

				$line = ($this->page == 1)
							? $i + 1
							: $i + 1 + (($this->page - 1) * $this->results_per_page);

				$last = $line; // Last line
				if ($first == 0)
					$first = $line; // First line

				if ($this->show_row_number)
					/*echo*/ echo '<td class="tbl-row-num" align="left">' . $line . '</td>';

				if ($this->show_checkboxes){
					if($this->clase=="Pagos"){
							
							$cant_serv=trim($row['cant_serv']);
							$costo_cobro=trim($row['costo_cobro']);
							$descu=trim($row['descu']);
							$total_pago=$cant_serv*$costo_cobro;
							
						/*echo*/ echo '<td class="numeric" align="center"><input type="checkbox" class="tbl-checkbox" name="checkbox" onchange="calcularMontoPago()" value="'.$row[$this->primary].'=@'.$total_pago.'=@'.$descu.'"></td>';
					}
					else if($this->clase=="grupo_ubicacion"){
							echo '<td class="numeric" align="center"><input type="checkbox" class="tbl-checkbox" name="checkbox_gu" value="' . $row[$this->primary] . '"></td>';
					}
					else{
						/*echo*/ echo '<td class="numeric" align="center"><input type="checkbox" class="tbl-checkbox" name="checkbox" value="' . $row[$this->primary] . '"></td>';
					}
				}
			
				foreach ($row as $key => $value)
				{
					
					if($this->clase=="Pagos" || $this->clase=="Actualizar_Pagos"  || $this->clase=="historialpago"  || $this->clase=="anular_pagos"){
						if(trim($key)=="cant_serv"){
							$cant_serv=trim($value);
						}
						if(trim($key)=="tipo_costo"){
							$tipo_costo=trim($value);
						}
						if(trim($key)=="costo_cobro"){
							$costo_cobro=trim($value);
						}
						if(trim($key)=="status_serv"){
							$value=$cant_serv*$costo_cobro;
							$this->sumatoria=$this->sumatoria+$value;
							if($value==''){
								$value=0;
							}
							$value=number_format($value+0, 2, ',', '.');
						}
						
						if(trim($key)=="fecha_inst"){
							
							$fec = explode ("-",$value);
							$me=$fec[1];
							$anio=$fec[0];
							$mes=array("01"=>"Enero","02"=>"Febre","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agost","09"=>"Septi","10"=>"Octub","11"=>"Novie","12"=>"Dicie");
							$f_mes=$mes[$me];
							if($tipo_costo=="COSTO MENSUAL"){
								$value="$f_mes $anio";
							}
							else{
								//$value = date("d/m/Y", strtotime($value));
							}
							
							
							//continue;
						}
					}
					else if($this->clase=="CierreDiario"){
						if(trim($key)=="apellido"){
							$apellido=$value;
						}
						
						if(trim($key)=="nombre"){
							$value=$value." ".$apellido;
						}
						
					}
					else if($this->clase=="status_contrato"){
						if(trim($key)=="apellido"){
							$apellido=$value;
						}
						
						if(trim($key)=="nombre"){
							$value=$value." ".$apellido;
						}
						
						if(trim($key)=="id_persona"){
							$value=$deuda;
						}
						
					}
				
					else if($this->clase=="rep_libroventa"){
						if(trim($key)=="cedulacli"){
							if(trim($row['tipo_cliente'])=="JURIDICO"){
								$value=trim($row['inicial_doc'])."-".$value;
							}
							else{
								$value="V-".$value;
							}
						}
						else if(trim($key)=="tipo_cliente"){
							
							if(trim($value)=="JURIDICO"){
								$value="CONTRIBUYENTE";
							}
							else{
								$value="NO-CONTRIBUYENTE";
							}
						}
						if(trim($key)=="base"){
								
							$por_iva=trim($fila['valor_param']);
							
							
							$total_p=$value;
							
							$porc=($por_iva/100)+1;
							$value=$total_p/$porc;
							
					  }
					  else if(trim($key)=="iva"){
								$por_iva=trim($fila['valor_param']);
					
							$total_p=$value;
							$porc=($por_iva/100)+1;
							$base=$total_p/$porc;
							$value=($base*$por_iva)/100;
					  }
					  else if(trim($key)=="fecha_pago"){
						
					  }
					}
					else if($this->clase=="reimp_ordenes"){
						if(trim($key)=="fecha_orden"){
							
						}
						if(trim($key)=="apellido"){
							$apellido=trim($value);
						}
						if(trim($key)=="nombre"){
							$value = $value." ".$apellido;
						}
					}
					
					if (in_array($key, $this->hidden))
						continue;
						
					

					// Apply a column type to the value
					if (array_key_exists($key, $this->type))
					{
						list($type, $criteria, $criteria_2) = $this->type[$key];

						switch ($type)
						{
							case self::TYPE_ONCLICK:
								if ($value)
									$value = '<a href="javascript:;" onclick="' . $this->parseVariables($row, $criteria) . '">' . $value . '</a>';
								break;

							case self::TYPE_HREF:
								if ($value)
									$value = '<a href="' . $this->parseVariables($row, $criteria) . '">' . $value . '</a>';
								break;

							case self::TYPE_DATE:
								if ($criteria_2 == true)
									$value = date($criteria, strtotime($value));
								else
									$value = date($criteria, $value);
								break;
							case self::TYPE_MONTO:
									if($value==''){
										$value=0;
									}
									$value = number_format($value+0, 2, ',', '.');
								break;

							case self::TYPE_IMAGE:
								$value = '<img src="' . $this->parseVariables($row, $criteria) . '" id="' . $key . '-' . $i . '">';
								break;

							case self::TYPE_ARRAY:
								$value = $criteria[$value];
								break;

							case self::TYPE_CHECK:
								if ($value == '1' or $value == 'yes' or $value == 'true' or ($criteria != '' and $value == $criteria))
									$value = '<img src="' . $this->image_path . 'check.gif">';
								break;

							case self::TYPE_PERCENT:
								if ($criteria == true)
									$value *= 100; // Value is in decimal format

								$value = round($value); // Round to the nearest decimal

								$value .= '%';

								// Apply a bar if an array is supplied via criteria_2
								if (is_array($criteria_2))
									$value = '<div style="background: ' . $criteria_2['Back'] . '; width: ' . $value . '; color: ' . $criteria_2['Fore'] . ';">' . $value . '</div>';
								break;

							case self::TYPE_DOLLAR:
								$value = '$' . number_format($value, 2);
								break;

							case self::TYPE_CUSTOM:
								$value = $this->parseVariables($row, $criteria);
								break;

							case self::TYPE_FUNCTION:
								if (is_array($criteria_2))
									$value = call_user_func_array($criteria, $this->parseVariables($row, $criteria_2));
								else
									$value = call_user_func($criteria, $this->parseVariables($row, $criteria_2));
								break;

							default:
								// Invalid column type
								break;
							}
					}
					
			
					echo '<td class="tbl-cell">' . $value . '</td>';
				}

				$this->buildControls($row);

				/*echo*/ echo '</tr>';

				$i++;
				$this->i_e++;
			}
					if($this->clase=="DetalleCobros"){
						
					//	$this->row_count=$y++;
						
					}
		}

		/*echo*/ echo '</tbody>';

		$this->buildFooter($i, $first, $last);

		/*echo*/ echo '</table>';
		
		//echo $this->modo;
		if($this->modo=="HTML"){
			echo $this->echo_t;
		}
		
	}

	/**
	 * Prints out script to handle Ajax data grids
	 *
	 * @param string $responce Responce script
	 */
	public static function useAjaxTable($responce = '')
	{	
	}

	/**
	* Prints the required JS functions
	*
	*/
	public function printJavascript()
	{
		
	}
	
}