public function getCards()
{

$response = array();

$postData = $this->input->post();

if (isset($postData['ref_no']) && !empty($postData['ref_no'])) {

$sqlQuery = "select * from tbl_cards where pin='" . $postData['ref_no'] . "'";

$data = $this->common->getRowQuery($sqlQuery);

if (empty($data)) {
$response['result'] = (object)[];
$response['message'] = 'PIN does not exist';
$response['status'] = 'false';
$response['code'] = '202';
echo json_encode($response);
exit;
}

else{

$sqlQuery = "select * from tbl_subscription where ref_no='" . $postData['ref_no'] . "'";

$data = $this->common->getRowQuery($sqlQuery);

if (empty($data)) {

$this->common->save('tbl_subscription', $postData);

$response['result'] = isset($result) ? $result : '';
$response['message'] = 'succcess';
$response['status'] = 'true';
$response['code'] = '200';
echo json_encode($response);
exit
}

else{
$response['message'] = 'PIN is already in use';
$response['status'] = 'false';
$response['code'] = '202';
echo json_encode($response);
exit;

}
}

}
else{
$response['result'] = (object)[];
$response['message'] = 'Some parameters missing';
$response['status'] = 'false';
$response['code'] = '202';
echo json_encode($response);
exit;
}

}
