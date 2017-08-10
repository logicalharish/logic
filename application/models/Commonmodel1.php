<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Commonmodel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getSession($strVarName)
	{
		return $this->session->userdata('sesW2sAdmin_' . $strVarName);
	}

	public function setSession($strVarName, $strValue)
	{
		$this->session->set_userdata('sesW2sAdmin_' . $strVarName, $strValue);
	}

	public function setMessage($strMessage)
	{
		switch ($strMessage) {
			case 'ADD_RECORD':
				$strMessage = '<div class="msg_success">Record(s) added successfully.</div>';
				break;

			case 'UPDATE_RECORD':
				$strMessage = '<div class="msg_success">Record(s) updated successfully.</div>';
				break;

			case 'DELETE_RECORD':
				$strMessage	 = '<div class="msg_success">Record(s) deleted successfully.</div>';
				break;
			case 'INACTIVE_RECORD':
				$strMessage	 = '<div class="msg_success">Record(s) inactive successfully.</div>';
				break;
			case 'ACTIVE_RECORD':
				$strMessage	 = '<div class="msg_success">Record(s) active successfully.</div>';
				break;
			case 'EMAIL_SUCCESS':
				$strMessage	 = '<div class="msg_success">Your email successfully send.</div>';
				break;
		}

		$this->session->set_userdata('sesMessage', $strMessage);
	}

	public function getMessage()
	{
		// Get Message
		$strMessage = $this->session->userdata('sesMessage');

		// Unset Message
		$this->session->unset_userdata('sesMessage');

		return $strMessage;
	}

	public function formatDateDB($strDate)
	{
		$strDate = date('Y-m-d H:i:s', strtotime($strDate));
		return $strDate;
	}

	public function generateCombo($strControlName, $arrOptions, $strExtraParams = "", $strSelValue = "", $blnMultiSelect = false, $strBlankOption = '')
	{
		$strControlId	 = $strControlName;
		$strMultiple	 = '';
		$strHtml		 = '';
		$arrSelValue	 = explode(',', $strSelValue);

		if ($blnMultiSelect == true)
		{
			$strMultiple	 = 'multiple="multiple"';
			$strControlName	 = $strControlName . '[]';
		}

		$strHtml .= '<select name="' . $strControlName . '" id="' . $strControlId . '"  ' . $strExtraParams . ' ' . $strMultiple . '>';
		if (is_array($arrOptions) && count($arrOptions) > 0)
		{
			if ($strBlankOption != '')
			{
				$strHtml .= '<option value="">' . $strBlankOption . '</option>';
			}
			foreach ($arrOptions as $key => $value)
			{
				if (in_array($key, $arrSelValue))
					$strSelected = 'selected';
				else
					$strSelected = '';

				$strHtml .= '<option value="' . $key . '" ' . $strSelected . '>' . $value . '</option>';
			}
		}

		$strHtml .= '</select>';

		return $strHtml;
	}

	function getComboOptions($strCaseName, $strOrderColumn = '')
	{

		$sqlQuery = "SELECT
							combo_key, combo_value from combo_master
						WHERE
							combo_case = '" . $strCaseName . "' ";

		if ($strOrderColumn != '')
		{
			$sqlQuery .= ' ORDER BY $strOrderColumn  ';
		}

		$result		 = $this->db->query($sqlQuery);
		$rsData		 = $result->result_array();
		$arrOptions	 = array();
		foreach ($rsData as $arrRec)
		{
			$arrOptions[$arrRec["combo_key"]] = $arrRec["combo_value"];
		}
		return $arrOptions;
	}

	public function generateComboByCase($strCaseName, $strControlName, $strExtraParams = "", $strValue = "")
	{
		$arrOptions	 = $this->getComboOptions($strCaseName);
		$strHtml	 = '';
		$strHtml	 .= '<select name="' . $strControlName . '" id="' . $strControlName . '"  ' . $strExtraParams . ' >';

		if (is_array($arrOptions) && count($arrOptions) > 0)
		{
			foreach ($arrOptions as $key => $value)
			{
				if ($strValue == $key)
					$strSelected = 'selected="selected"';
				else
					$strSelected = '';

				$strHtml .= '<option value="' . $key . '" ' . $strSelected . '>' . $value . '</option>';
			}
		}

		$strHtml .= '</select>';
		return $strHtml;
	}

	public function generateComboFromTable($strTableName, $strKeyColumn, $strValueColumn, $strControlName, $strExtraParams = "", $strSelValue = "", $blnMultiSelect = false, $strOrderColumn = '', $strBlankOption = '')
	{
		if ($strOrderColumn == '')
		{
			$strOrderColumn = $strValueColumn;
		}
		$strQuery	 = "SELECT $strKeyColumn, $strValueColumn FROM $strTableName ORDER BY $strOrderColumn";
		$rsResult	 = $this->db->query($strQuery);
		$rsOptions	 = $rsResult->result_array();

		$arrOptions = array();
		foreach ($rsOptions as $option)
		{
			$arrOptions[$option[$strKeyColumn]] = $option[$strValueColumn];
		}

		return $this->generateCombo($strControlName, $arrOptions, $strExtraParams, $strSelValue, $blnMultiSelect, $strBlankOption);
	}

	public function getActiveInativeCombo($strControlName, $strExtraParams = "", $strValue = "")
	{
		$strActive	 = ($strValue == '1' || $strValue == 'Active') ? 'selected' : '';
		$strInactive = ($strValue == '2' || $strValue == 'Inactive') ? 'selected' : '';

		$strHtml = '';
		$strHtml .= '<select class="form-control simple-select" name="' . $strControlName . '" id="' . $strControlName . '"  ' . $strExtraParams . ' >';
		$strHtml .= '<option value="Active" ' . $strActive . '>Active</option>';
		$strHtml .= '<option value="Inactive" ' . $strInactive . '>Inactive</option>';
		$strHtml .= '</select>';

		return $strHtml;
	}

	public function getSetting($strCaseName)
	{
		$strQuery	 = "SELECT var_value FROM settings WHERE var_key = '" . $strCaseName . "'";
		$rsResult	 = $this->db->query($strQuery);
		$rsRecord	 = $rsResult->result_array();
		return $rsRecord[0]['var_value'];
	}

	public function uploadImageFile($strControlName, $strUploadPath, $intRecordId, $strUploadFor, $blnResizeImage = false, $imgWidth = "", $imgHeight = "")
	{
		$arrFile	 = $_FILES[$strControlName];
		$arrFileInfo = pathinfo($arrFile['name']);

		$strExtension = $arrFileInfo['extension'];

		$strUplaodFileName = $intRecordId . "." . $strExtension;

		$arrConfig['upload_path']	 = $strUploadPath;
		$arrConfig['allowed_types']	 = 'gif|jpg|png';
		$arrConfig['file_name']		 = $strUplaodFileName;
		$arrConfig['overwrite']		 = true;

		$this->load->library('upload', $arrConfig);
		$this->upload->initialize($arrConfig);

		if (!$this->upload->do_upload($strControlName))
		{
			$error = array('error' => $this->upload->display_errors());
			return false;
		} else
		{
			$image_data = $this->upload->data();


			if ($blnResizeImage == true)
			{
				$config = array(
					'source_image'		 => $image_data['full_path'],
					'new_image'			 => $strUploadPath,
					'maintain_ration'	 => true,
					'width'				 => $imgWidth,
					'height'			 => $imgHeight
				);

				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}


			// Insert Upload Record
			$arrRecord['original_file_name'] = $arrFileInfo['basename'];
			$arrRecord['uploaded_file_name'] = $strUplaodFileName;
			$arrRecord['upload_for']		 = $strUploadFor;
			$arrRecord['record_id']			 = $intRecordId;


			// Insert Entry into Uploads Table
			$strQuery = "INSERT INTO uploads (" . implode(",", array_keys($arrRecord)) . ")
						VALUES ('" . implode("','", array_values($arrRecord)) . "')";

			$this->db->query($strQuery);

			return $this->db->insert_id();
		}
	}

	public function getUploadDetails($intUploadId)
	{
		$strQuery	 = "SELECT * FROM uploads WHERE upload_id = '" . $intUploadId . "'";
		$rsResult	 = $this->db->query($strQuery);
		$rsUpload	 = $rsResult->result_array();
		return $rsUpload[0];
	}

	public function getUploadHtml($intUploadId, $strUploadPath)
	{
		$strHtml = "";
		if ($intUploadId > 0)
		{
			$strSiteURL = $this->Fyimodel->getSetting('site_url()');

			$strFilePath = $this->Fyimodel->getSetting($strUploadPath);
			$rsUpload	 = $this->Fyimodel->getUploadDetails($intUploadId);
			$strFile	 = $strSiteURL . $strFilePath . $rsUpload['uploaded_file_name'];

			$strHtml = "&nbsp;<span>";
			//$strHtml	.=	'<a href="index.php?c=common&m=download&path='.$strUploadPath.'&upload='.$intUploadId.'" >View</a>';
			$strHtml .= '<a href="' . $strFile . '" class="thickbox">View</a>';
			//$strHtml	.=	'&nbsp;|&nbsp;';
			//$strHtml	.=	'<a href="index.php?c=common&m=remove&path='.$strUploadPath.'&upload='.$intUploadId.'">Remove</a>';
			$strHtml .= "</span>";
		}

		return $strHtml;
	}

        function getByID($strTable, $colname, $value)
	{
		$this->db->where($colname, $value);
		$rsReturn = $this->db->get($strTable)->result();
		return $rsReturn[0];
	}

	function getRecords($strTableName, $columns = "", $where = "", $order = "")
	{
		if ($columns != '')
			$this->db->select($columns);

		if ($where != '')
			$this->db->where($where);

		if ($order != '')
			$this->db->order_by($order);

		return $this->db->get($strTableName)->result();
	}

	function getRecordsArray($strTableName, $columns = "", $where = "", $order = "")
	{
		if ($columns != '')
			$this->db->select($columns);

		if ($where != '')
			$this->db->where($where);

		if ($order != '')
			$this->db->order_by($order);

		return $this->db->get($strTableName)->result_array();
	}

	function getRecord($strTableName, $columns = "", $where = "", $order = "")
	{
		if ($columns != '')
			$this->db->select($columns);

		if ($where != '')
			$this->db->where($where);

		if ($order != '')
			$this->db->order_by($order);

		return $this->db->get($strTableName)->result_array();
	}

	function insert($tbl, $record)
	{
		$this->db->insert($tbl, $record);
		return $this->db->insert_id();
	}

	function update($strTableName, $record, $arrWhere)
	{ //$this->db->where($where);
		$this->db->update($strTableName, $record, $arrWhere);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tbl);
	}

	function get_all_ajax($arrFieldName, $strTableName, $sortBy = '', $sortOrder = '', $search = '', $limit = 10, $offset = 0, $findBy = '')
	{
		//$arrFieldName = array('id', 'month', 'year', 'hrid', 'user_id', 'job_id', 'dictation_date', 'submitted_date', 'customer_number', 'expected_tat', 'tat', 'dsp_typed', 'nondsp_typed', 'dsp_edited', 'nondsp_edited', 'direct_pend');

		$sortBy		 = (empty($sortBy) || $sortBy == "") ? "id" : $sortBy;
		$sortOrder	 = (empty($sortOrder)) ? "desc" : $sortOrder;
		$where		 = "";
		if (!empty($search))
		{
			//print_r($arrFieldName);
			//$search = array();
			for ($intIndex = 0; $intIndex < count($arrFieldName); $intIndex++)
			{
				$arrSearch[$arrFieldName[$intIndex]] = $search;
			}
//				echo "<pre>";
//				print_r($arrSearch);
//				die;
			//$search = array('shop_title' => 'f');

			$searchParam = '';
			foreach ($arrSearch as $key => $value)
			{

				if (empty($searchParam))
				{
					$searchParam .= $key . " LIKE '%" . $value . "%'";
				} else
				{
					$searchParam .= " OR " . $key . " LIKE '%" . $value . "%' ";
				}
			}

			$where .= '1=1 AND (' . $searchParam . ')';
		}

		if (!empty($findBy))
		{

			if (!empty($findBy['month']))
			{
				if (!empty($search))
				{
					$where .= " AND  month='" . $findBy['month'] . "'";
				}
				else
				{
					$where .= "   month='" . $findBy['month'] . "'";
				}
			}
		}

		$this->db->select($arrFieldName);
		$this->db->from($strTableName);
		if (!empty($where))
		{
			$this->db->where($where);
		}
		$this->db->order_by($sortBy, $sortOrder);
		if ($limit > 0)
		{
			$this->db->limit($limit, $offset);
		}
		$query	 = $this->db->get();
		//echo $this->db->last_query();exit;
		$arrData = $query->result_array();

		return $arrData;
	}

	function getListing($strControlername, $strTableName, $intPK, $arrField, $dataTableColumns)
	{
		$request_data = $this->comman_lib->get_data();

		$param = $this->comman_lib->sendCustomParametersWithPagination($request_data, $dataTableColumns);

		$records = $this->Commonmodel->get_all_ajax($arrField, $strTableName, $param['SortBy'], $param['SortOrder'], $param['Search'], $request_data['iDisplayLength'], $request_data['iDisplayStart'], $request_data);

		$totalRecords	 = count($this->Commonmodel->get_all_ajax($arrField, $strTableName, $param['SortBy'], $param['SortOrder'], $param['Search'], 0, 0, $request_data));
		$arrData		 = array();
		//print_r($records);die;
		//foreach ($records as $key =>$record)
		for ($intIndex = 0; $intIndex < count($records); $intIndex++)
		{   
                        $strLink	 = '<a href="' . site_url() . $strControlername . "/add/{$records[$intIndex][$intPK]}" . '"><i class="material-icons">mode_edit</i></a>
                                            <a onClick="return confirm(\'Are You Sure Delete Record!\');" href="' . site_url() . $strControlername . "/delete/{$records[$intIndex][$intPK]}" . '"><i class="material-icons">delete_forever</i></a>';
			if($strControlername == 'invoices')
                        {
                           $strLink	 .= '<a href="' . site_url() . $strControlername . "/printInvoice/{$records[$intIndex][$intPK]}" . '"><i class="large material-icons">assignment</i></a>';
                        }
			
                        array_push($records[$intIndex], $strLink);
			unset($records[$intIndex][$intPK]);
			$arrData[]	 = array_values($records[$intIndex]);
			//$arrData[] = ($records[$intIndex]);
		}


		$records				 = $arrData;
		$data['records']		 = $records;
		$data['totalRecords']	 = $totalRecords;
		$data['totalRecords']	 = $totalRecords;
		$data['draw']			 = $request_data;
		$data['data']			 = $records;

		return $data;
	}

	function getListings($strControlername, $strTableName, $intPK, $arrField, $dataTableColumns)
	{
		$request_data = $this->comman_lib->get_data();
		
		$param = $this->comman_lib->sendCustomParametersWithPagination($request_data, $dataTableColumns);

		$records = $this->Commonmodel->get_all_ajax($arrField, $strTableName, $param['SortBy'], $param['SortOrder'], $param['Search'], $request_data['iDisplayLength'], $request_data['iDisplayStart'], $request_data);

		$totalRecords	 = count($this->Commonmodel->get_all_ajax($arrField, $strTableName, $param['SortBy'], $param['SortOrder'], $param['Search'], 0, 0, $request_data));
		$arrData		 = array();
		//print_r($records);die;
		//foreach ($records as $key =>$record)
		for ($intIndex = 0; $intIndex < count($records); $intIndex++)
		{
			$strLink	 = '<a href="' . site_url() . $strControlername . "/add/{$records[$intIndex][$intPK]}" . '"><i class="material-icons">mode_edit</i></a>
                <a onClick="return confirm(\'Are You Sure Delete Record!\');" href="' . site_url() . $strControlername . "/delete/{$records[$intIndex][$intPK]}" . '"><i class="material-icons">delete_forever</i></a>';
			array_push($records[$intIndex], $strLink);
//			unset($records[$intIndex][$intPK]);
			$arrData[]	 = array_values($records[$intIndex]);
			//$arrData[] = ($records[$intIndex]);
		}


		$records				 = $arrData;
		$data['records']		 = $records;
		$data['totalRecords']	 = $totalRecords;
		$data['totalRecords']	 = $totalRecords;
		$data['draw']			 = $request_data;
		$data['data']			 = $records;

		return $data;
	}

        
	function get_user_access($id)
	{
		$where	 = array('aid' => $id);
		$this->db->select('*');
		$this->db->from('tbl_admin_access');
		$this->db->where($where);
		$query	 = $this->db->get();
		$result	 = $query->result_array();
		if (!empty($result))
		{
			return $result[0];
		} else
		{
			return $result;
		}
	}

	function checkLogin($strUsername, $strPassword)
	{

		$where = array('type' => 'Admin', 'email' => $strUsername, 'password' => $strPassword);
                $this->db->select('*');
                $this->db->from('tbl_user');
		$this->db->where($where);
		$query	 = $this->db->get();
		$result	 = $query->result_array();
		if (!empty($result))
		{
			return $result[0];
		} else
		{
			return $result;
		}
	}

	function deleteRecord($strTableName, $strFieldName, $strFieldValue)
	{
//			echo $strTableName;
//			echo "<br>";
//			echo $strFieldName;
//			echo "<br>";
//			echo $strFieldValue;

		$this->db->where($strFieldName, $strFieldValue);
		$this->db->delete($strTableName);
		return true;
	}

	// locationlist
        public function customerlist($id = '')
	{
		if ($id != '')
		{
			return $this->db->get_where('customers', array('id' => $id))->result();
		} else
		{
			return $this->db->get("customers")->result();
		}
	}
        
        public function userlist($id = '')
	{
		if ($id != '')
		{
			return $this->db->get_where('tbl_user', array('id' => $id))->result();
		} else
		{
			return $this->db->get("tbl_user")->result();
		}
	}
        
        public function memberlist($id = '') {

            if ($id != '') {

                return $this->db->get_where('tbl_user', array('id' => $id, 'type' => 'member'))->result();
            } else {

                return $this->db->get("tbl_user")->result();
            }
        }

	public function doesRecordExist($table, $condKey, $condValue)
	{
		try {
			$strQuery	 = "SELECT COUNT(*) as CNT FROM $table WHERE $condKey = '$condValue'";
			$rsResult	 = $this->db->query($strQuery);
			$rsRecord	 = $rsResult->result_array();
			return $rsRecord[0]['CNT'];
		} catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage() . 'in doesRecordExist';
		}
	}


	public function customQuery($strQuery)
	{
		$rsResult	 = $this->db->query($strQuery);
		$rsRecord	 = $rsResult->result_array();
		return $rsRecord;
	}
        
        public function getSerachData($tableName, $columns, $keyword)
        {
            $strQuery    = "select * from $tableName where $columns like'%$keyword%'";
            $rsResult	 = $this->db->query($strQuery);
            $rsRecord	 = $rsResult->result_array();
            return $rsRecord;
        }

}

/* End of file city.php */
/* Location: ./application/models/Fyimodel.php */