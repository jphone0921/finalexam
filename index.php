<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">

  <title>電子化流程設計與管理</title>
</head>

<body>

<?php
require_once(__DIR__ . "/config.php");
ini_set ("soap.wsdl_cache_enabled", "0");
$client = new SoapClient($conf['EasyFlowServer']);

if($_POST){
    if(
        !empty($_POST['oid'])
        && !empty($_POST['uid'])
        && !empty($_POST['eid'])
    ) {

        // 參數設定
        $oid = $_POST['oid'];
        $uid = $_POST['uid'];
        $eid = $_POST['eid'];
		$oid = $_POST['oid'];
		$date = $_POST['date'];
		$timeA = $_POST['timeA'];
		$timeA1 = $_POST['timeA1'];
		$timeB = $_POST['timeB'];
		$timeB1 = $_POST['timeB1'];
		$q = $_POST['q'];
		$RadioButton14 = $_POST['RadioButton14'];
		$RadioButton17 = $_POST['RadioButton17'];
		$textarea7 = $_POST['textarea7'];
		
        // 送到流程管理
        try{
            $procesesStr = $client->findFormOIDsOfProcess($oid);

            $proceses = explode(",", $procesesStr);
            $process = $proceses[0];
            $template = $client->getFormFieldTemplate($process);

            $form = simplexml_load_string($template);
            $form->Textbox7 = $eid;
            $form->Textbox1 = $uid;
            $form->Textbox9 = $date;
			$form->Textbox11 = $timeA;
			$form->Textbox2 = $timeA1;
			$form->Textbox5 = $timeB;
			$form->Textbox0 = $timeB1;
			$form->RadioButton17 = $RadioButton17;
			$form->TextArea7 = $textarea7;
			$form->Textbox12 = $q;
			$form->RadioButton14 = $RadioButton14;
			
			
			
            $result = $form->asXML();
            $client->invokeProcess($oid, $eid, $uid, $process, $result, "伺服器代管申請作業");
        }catch(Exception $e){
        echo $e->getMessage();
        }

    } else {
        echo "系統錯誤";
    }
    
}

?>

  <div class="container">
    <div class="py-5 text-center">
      <h2>電子化流程設計與管理</h2>
    </div>

    <div class="row">

      <div class="col-md-12 order-md-1">
        <h4 class="mb-3"></h4>
        <form class="needs-validation" method="POST" action="./index.php">
          <div class="row">
            <div class="col-md-6 mb-2">
              <label for="eid">員工編號</label>
              <input name="eid" type="text" class="form-control" id="eid" placeholder="" value="" required>
              <div class="invalid-feedback">
                員工編號 必填
              </div>
            </div>
        
              <div class="col-md-6 mb-2">
                  <label for="uid">員工單位編號</label>
                  <input name="uid" type="text" class="form-control" id="uid" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    員工單位編號 必填
                  </div>
                </div>
          </div>

          <div class="row">
              <div class="col-md-12 mb-2">
                  <label for="oid">流程編號</label>
                  <input name="oid" type="text" class="form-control" id="oid" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    流程編號 必填
                  </div>
                </div>
          </div>

		  
		  
		  
          <div class="row">
              <div class="col-md-12 mb-2">
                  <label for="date"></label>申請日期
                  <input name="date" type="date" class="form-control" id="date" placeholder="" value="" required>
                  <div class="invalid-feedback">
                   申請日期
                  </div>
                </div>
          </div>

          <div class="row">
              <div class="col-md-10 mb-2">
                  <label for="timeA">刊登時間</label>
                  <input name="timeA" type="date" class="form-control" id="timeA" placeholder="" value="0" required>
				  </div>
				  <div class="col-md-1 mb-2">
				  <label for="timeA1">&nbsp;</label>
				   <input name="timeA1" type="number" class="form-control" id="timeA1" placeholder="時" min="0" max="23" required>
				   
                  <div class="invalid-feedback">
                    刊登時間
                  </div>
                </div>
				
			  <div class="col-md-10 mb-2">
                  <label for="timeB">到</label>
                  <input name="timeB" type="date" class="form-control" id="timeB" placeholder="" value="0" required>
				  </div>
				  <div class="col-md-1 mb-2">
				  <label for="timeB1">&nbsp;</label>
				   <input name="timeB1" type="number" class="form-control" id="timeB1" placeholder="時" min="0" max="23" required>
                  <div class="invalid-feedback">
                    截止時間
                  </div>
                </div>
          </div>
			
			<div class="row">
              <div class="col-md-12 mb-2">
                  <label for="q"></label>目的
                  <input name="q" type="text" class="form-control" id="q" placeholder="" value="" required>
                  <div class="invalid-feedback">
                   目的
                  </div>
                </div>
          </div>
			<div class="row">
              <div class="col-md-4 mb-2">
                  <label ><strong>申請事項</strong></label>
				  <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton14" id="RadioButton1" value="A">
						  <label class="form-check-label" for="RadioButton1">
							Banner(1004x300像素)
						  </label>
						  </div>
						  <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton14" id="RadioButton2" value="B">
						  <label class="form-check-label" for="RadioButton2">
							跑馬燈
						  </label>
						   </div>
						  <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton14" id="RadioButton3" value="C">
						  <label class="form-check-label" for="RadioButton3">
							快速連結
						  </label>
						   </div>
						  <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton14" id="RadioButton4" value="D">
						  <label class="form-check-label" for="RadioButton4">
							網頁內容
						  </label>
						   </div>
						  <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton14" id="RadioButton5" value="E">
						  <label class="form-check-label" for="RadioButton5">
							網頁版面
						  </label>
						   </div>
						  <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton14" id="RadioButton6" value="F">
						  <label class="form-check-label" for="RadioButton6">
							增建帳號
						  </label>
						   </div>
						  <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton14" id="RadioButton7" value="G">
						  <label class="form-check-label" for="RadioButton7">
							其他
						  </label>
						   </div>						   						  						                                   			
                <div class="invalid-feedback">
                    申請事項
                  </div>
              </div>
				
				
              <div class="col-md-4 mb-3">
                  <label ><strong>協助事項</strong></label>
				  <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton17" id="RadioButton8" value="8">
						  <label class="form-check-label" for="RadioButton8">
							新增
						  </label>
						  </div>
						  <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton17" id="RadioButton9" value="9">
						  <label class="form-check-label" for="RadioButton9">
							修改
						  </label>
						   </div>
						   <div class="form-check" >
						  <input class="form-check-input" type="radio" name="RadioButton17" id="RadioButton10" value="10">
						  <label class="form-check-label" for="RadioButton10">
							刪除
						  </label>
						  </div>
						  <div class="invalid-feedback">
                    協助事項
                  </div>
							</div>
							
							 <div class="col-md-4 mb-3">
                  <label ><strong>申請事項說明</strong></label>
				  <div class="form-check" >
						  <textarea  name="textarea7" class="form-control" id="textarea7" placeholder="" value="" rows="5"   required ></textarea>
						  <div class="invalid-feedback">
                    申請事項說明
                  </div>
						  </div>
						  
							</div>
					</div>
	
		  <div class="row">
              <div class="col-md-12 mb-2">
                  <label id="label_center" for="textarea_2" ><strong>注意事項</strong></label>
                   <textarea readonly  name="textarea_2" class="form-control"  placeholder="" value="" rows="4"    >1. 申請事項說明以簡單扼要為原則。
2. 申請單位應負刊登文字責任。
3. 相關檔案請寄到公務信箱banner：bcoffice01@nkust.edu.tw (請在刊登日前3天寄出)。
				   其他： chunting@nkust.edu.tw</textarea>
                  <div class="invalid-feedback">
                   注意事項
                  </div>
                </div>
          </div>
			
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">送出</button>
        </form>
      </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2017-2018 NKUST MIS</p>
    </footer>
  </div>

  <!-- Bootstrap core JavaScript
        ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict';

      window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');

        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>

</html>