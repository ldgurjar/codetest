<div id="screen1" ng-app="questionApp" ng-controller="questionCtrl" >
<!-- Contenter -->
<div class="container" >
    <header><h1>ADD New CALL</h1></header>
    <section class="questionsection" >
       <div class="row">
          <div class="col-sm-12">
             <form name="questionform" id="questionform" action="" method="POST">
                  <div id="contentloader"></div>
            </form>
          </div>
      </div>
    </section>  
    <section class="addquestionsection">
        <button type="button" class="btn btn-default pull-right" ng-click="AddQuestionControl()" > <span class="glyphicon glyphicon-plus" ></span> ADD NEW QUESTION</button>
    </section>
    <footer>
      <button type="button" name="save" value="save" class="btn btn-primary">Save</button>
      <button type="button" class="btn btn-default" >Cancel</button>
      
    </footer>
  </div>
</div>
<script>
var app = angular.module('questionApp', []);
app.controller('questionCtrl', ['$rootScope', '$scope', '$compile', '$element', '$filter', '$log','ContactTypesService', function($rootScope, $scope, $compile, $element, $filter,$log ,ContactTypesService) {

   $scope.options =["Multiline Text","Single Choice","Multipule Choice"];
   $rootScope.GetContactTypes = ContactTypesService.ContactTypes();
  
  var employee={firstName:'',lastName:'',contacts:''}
  var employeeList = [];
  
  $scope.AddQuestionControl = function() {
    
    var divElement = angular.element(document.querySelector('#contentloader'));
    var appendHtml = $compile('<contact-Type></contact-Type>')($scope);
    divElement.append(appendHtml);
  }
  $scope.AddSubQuestionControl = function() {
    
    var divElement = angular.element(document.querySelector('#contentloader'));
    var appendHtml = $compile('<contact-Type></contact-Type>')($scope);
    divElement.append(appendHtml);
  }
  var GetContactType = function(id) {
    return $filter('filter')($rootScope.GetContactTypes, {
      contactId: id
    })[0].contactType;
  }
  var retriveValue = function() {
    // http://stackoverflow.com/questions/12649080/get-to-get-all-child-scopes-in-angularjs-given-the-parent-scope
    var UserContacts = [];
    var ChildHeads = [$scope.$$childHead];
    var currentScope;
    while (ChildHeads.length) {
      currentScope = ChildHeads.shift();
      while (currentScope) {
        if (currentScope.ContactType !== undefined)
          UserContacts.push({
            ContactType: GetContactType(currentScope.ContactType),
            ContactValue: currentScope.ContactValue
          });

        currentScope = currentScope.$$nextSibling;
      }
    }
    return UserContacts;
  }

  var ClearControls = function(allContacts) {
    var i;
    for (i = 0; i < allContacts.length; i++)
      angular.element(allContacts[i]).remove();

    $scope.employee = '';
    $scope.employee.contacts = '';
    $scope.$$childHead = $scope.$new(true);

  }

  $scope.OnSave = function(emp) {
  
   if(emp!==null && emp!==undefined){
    emp.contacts = retriveValue($scope);
    employeeList.push(emp);
    $scope.EmployeeList = employeeList;
    var allContacts = angular.element(document.getElementsByTagName("contact-Type"));
    ClearControls(allContacts);
   }
  }
}]);

app.directive('contactType', function() {
  return {
    restrict: "E",
    scope: {},
    templateUrl:'<?php echo SITEURL; ?>/assets/html/question.html',
    controller: function($rootScope, $scope, $element,$compile) {
           $scope.answertypes = $rootScope.GetContactTypes;
           $scope.Delete = function(e) {
            //remove element and also destoy the scope that element
           $element.remove();
           $scope.$destroy();
          }
          $scope.AddSubQuestionControl = function(e) {
            var divElement = angular.element(document.querySelector('#subquestionloader'));
            var appendHtml = $compile('<contact-Type></contact-Type>')($scope);
            divElement.append(appendHtml);
          }
    }
  }
});

app.service("ContactTypesService", [function() {
  var list = [];
  return {
    ContactTypes: function() {
      list.push({contactId: 1,contactType: 'Multiline Text'});
      list.push({contactId: 2,contactType: 'Single Choice'});
      list.push({contactId: 3,contactType: 'Multipule Choice'});
      return list;
    }
  }
}]);
</script>