<div id="screen1" ng-app="questionApp" ng-controller="questionCtrl" >
<!-- Contenter -->
<div class="container" >
    <header><h1>ADD New CALL</h1></header>
    <section class="questionsection" >
       <div class="row">
          <div class="col-sm-12">
             <form name="questionform" id="questionform" action="" method="POST" novalidate>
                 <!-- <span>{{questiontext}} , {{question}}</span> -->
                  <div id="contentloader"></div>
            </form>
          </div>
      </div>
    </section>  
    <section class="addquestionsection">
        <button type="button" class="btn btn-default pull-right" ng-click="AddQuestionControl()" > <span class="glyphicon glyphicon-plus" ></span> ADD NEW QUESTION</button>
    </section>
    <footer>
      <button type="button" name="save" value="save" class="btn btn-primary" ng-click="OnSave()">Save</button>
      <button type="button" class="btn btn-default" ng-click="OnCancel()">Cancel</button>
      
    </footer>
  </div>
</div>
<script type="text/javascript" src="http://localhost/codetest/assets/js/app.js"></script>  

