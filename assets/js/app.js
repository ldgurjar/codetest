var app = angular.module('questionApp', []);
app.controller('questionCtrl', ['$rootScope', '$scope', '$compile', '$element', '$filter', '$log','ContactTypesService', function($rootScope, $scope, $compile, $element, $filter,$log ,ContactTypesService) {

   $scope.options =["Multiline Text","Single Choice","Multipule Choice"];
   $rootScope.GetContactTypes = ContactTypesService.ContactTypes();

   $scope.question = 0;
   $scope.AddQuestionControl = function() {
        $scope.question++;
        var divElement = angular.element(document.querySelector('#contentloader'));
       // var appendHtml = $compile('<contact-Type question={{question}} questiontext="questiontext"></contact-Type>')($scope);
       var appendHtml = $compile('<contact-Type question={{question}} ></contact-Type>')($scope);
        divElement.append(appendHtml);
   }
  
  var GetContactType = function(id) {
    return $filter('filter')($rootScope.GetContactTypes, {
      contactId: id
    })[0].contactType;
  }
  
  var ClearControls = function(allContacts) {
    var i;
    for (i = 0; i < allContacts.length; i++)
      angular.element(allContacts[i]).remove();
      $scope.$$childHead = $scope.$new(true);
  }
  $scope.OnCancel = function() {
     var conf= confirm("Do you want to refresh this page? you loss the data.")
     if(conf==true){
        window.location.reload();
     }
  }
  $scope.OnSave = function(questiondata) {
      
      var mainanswer = [];
      var subquestiondata=function(parentid){
      var subanswertext = [];
          $( parentid+" select[name*='subanswertypes_'] option:selected" ).each(function() {
            var answerid = $( this ).parent().attr('id').split("_");
            var optionValue = $( this ).text().trim();
            var questionelementid='#subquestiontext_'+answerid[1];
             subanswertext.push(
              {
                id: answerid[1],
                optionValue: optionValue ,
                questiontext:$(questionelementid).val(),
                answertext: suboValue(parentid, optionValue, answerid[1])
              });
          });
          return subanswertext;
      }

      var suboValue= function (parentid,optionValue, answerid) {
          var answervalue = [];
          switch(optionValue) {
            case "Multiline Text":
              var answertext = $(parentid+' #subq_'+answerid+'_MT_1').val();
                answervalue.push({
                      id:1, 
                      answertext:answertext,
                });
                return answervalue;
               break; 
            case "Single Choice":
                 $( parentid+" input[name*='subq_"+answerid+"_SC_']" ).each(function() {
                       var thisid = $( this ).attr('id').split("subq_"+answerid+"_SC_");
                       answervalue.push({
                            id:thisid[1], 
                            answertext:$(this).val()
                       });
                  });    
                return answervalue;
             break; 
             case "Multiple Choice":
                 $( parentid + " input[name*='subq_"+answerid+"_MC_']" ).each(function() {
                       var thisid = $( this ).attr('id').split("subq_"+answerid+"_MC_");
                       answervalue.push({
                            id:thisid[1], 
                            answertext:$(this).val(),
                      });
                  });    
                return answervalue;
             break;      
            default:
             return answervalue;
          }
      }

      var oValue= function (optionValue, answerid) {
          var answervalue = [];
          switch(optionValue) {
            case "Multiline Text":
               var atext=$("#Q_"+answerid+"_MT_1").val();
               //debugger ;
               answervalue.push({
                      id: 1, 
                      answertext: atext,
                      optionValue : optionValue,
                      hassubquestion:false,
                      subquestiondata:[]
                });
               return answervalue;
               break; 
            case "Single Choice":
                 $( "input[name*='Q_"+answerid+"_SC_']" ).each(function() {
                       var thisid = $( this ).attr('id').split("Q_"+answerid+"_SC_");
                       var haschild = ($( "#subquestionloader_Q_"+answerid+"_button_SC_"+thisid[1] ).children().length > 0) ? true : false;
                       var parentid = "#subquestionloader_Q_"+answerid+"_button_SC_"+thisid[1];

                       answervalue.push({
                            id:thisid[1], 
                            answertext:$(this).val(),
                            optionValue : optionValue,
                            hassubquestion:haschild,
                            subquestiondata:subquestiondata(parentid)
                      });
                  });    
                return answervalue;
             break; 
             case "Multiple Choice":
                 $( "input[name*='Q_"+answerid+"_MC_']" ).each(function() {
                       var thisid = $( this ).attr('id').split("Q_"+answerid+"_MC_");
                       var haschild = ($("#subquestionloader_Q_"+answerid+"_button_MC_"+thisid[1] ).children().length > 0) ? true : false;
                       var parentid = "#subquestionloader_Q_"+answerid+"_button_MC_"+thisid[1];
                       answervalue.push({
                            id:thisid[1], 
                            answertext:$(this).val(),
                            optionValue : optionValue,
                            hassubquestion:haschild,
                            subquestiondata:subquestiondata(parentid)
                      });
                  });    
                return answervalue;
             break;      
            default:
             return answervalue;
          }
      }

      $("select[name*='answertype_'] option:selected" ).each(function() {
        //console.log($(this).parent()attr('id'));
            var answerid = $( this ).parent().attr('id').split("_");
            var optionValue = $( this ).text().trim();
            var questionelementid='#q_questiontext_'+answerid[1];
            mainanswer.push(
              {
                id: answerid[1],
                optionValue: optionValue ,
                questiontext:$(questionelementid).val(),
                answertext: oValue(optionValue, answerid[1])
              });
       });
       //var jsonString = JSON.stringify(mainanswer);
       //console.log(mainanswer);
       //console.log(jsonString);
       
       if(mainanswer.length===0){
         console.log('You should select a question');
       }else{
          $.ajax({
              type: "POST",
              url: "http://localhost/codetest/index.php/main/savedata/",
              data: { QuestionData:  JSON.stringify(mainanswer) },
              //data:{name: "name",value:"xxxxx"},
              //contentType: "application/json; charset=utf-8",
              dataType: "json",
              cache: false,
              success: function (data) {
                  var html = '';
                  if(data == "data saved"){
                     html = "<div class='alert alert-success alert-dismissable'>" + 
                     "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+
                     "<strong>Success!</strong> You have successfully saved all question data</div>";
                  }else{
                     html = "<div class='alert alert-danger fade in alert-dismissable'>"+
                     "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+
                     "<strong>Error!</strong> Somthing went wrong to save questions.</div>";
                  }
                  $('#contentloader').html(html);
              },
              error: function(msg){
                 console.log(msg + "error here");
              }
          });
       }
    }
}]);

app.directive('contactType', function() {
  return {
    restrict: "E",
    scope: {
      question: '@question',
      //questiontext: '='
    },
    templateUrl:'http://localhost/codetest/assets/html/question.html', 
    
    controller: function($rootScope, $scope, $element,$compile) {
           $scope.answertypes = $rootScope.GetContactTypes;

           $scope.question_no = parseInt($scope.question);
          
           $scope.subquestioncounter = 0;
           //console.log($scope.questiontext);

           $scope.AddsubQuestionNo = function(e) {
              $scope.savedcounter = JSON.parse(localStorage.getItem(e.toElement.id+'_counter'));
              //console.log($scope.savedcounter);
              if($scope.savedcounter!=='null'){

                 localStorage.setItem(e.toElement.id+'_counter', JSON.stringify($scope.savedcounter));
                 return $scope.subquestioncounter = $scope.savedcounter + 1;

               }else{

                 return $scope.subquestioncounter = $scope.subquestioncounter + 1;

               }
             
           }
           $scope.Delete = function(e) {
              //remove element and also destoy the scope that element
               $element.remove();
               $scope.$destroy();
          }
          $scope.AddSubQuestionControl = function(e) {
             
            var counter =$scope.AddsubQuestionNo(e);
            localStorage.setItem(e.toElement.id+'_counter', JSON.stringify(counter));
            //console.log(counter);
            //$scope.AddsubQuestionNo();
            //debugger;
            var elementId="subquestionloader_"+e.toElement.id;
            var divElement = angular.element(document.querySelector('#'+elementId));

            var appendHtml = $compile('<div sub-question subquestioncounter={{subquestioncounter}}></div>')($scope);
            divElement.append(appendHtml);
           }
    }
  }
});
app.directive('subQuestion', function() {

  return {
    templateUrl:'http://localhost/codetest/assets/html/subquestion.html',
    scope: {
      subquestioncounter:'@subquestioncounter'
    },
    controller: function($rootScope, $scope, $element,$compile) {
            $scope.subanswertypes = $rootScope.GetContactTypes;
            //debugger;
            $scope.subquestioncounter_no = parseInt($scope.subquestioncounter);
           //console.log($scope.subquestioncounter);
           
           $scope.Delete = function(e) {
               $element.remove();
               $scope.$destroy();
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
      list.push({contactId: 3,contactType: 'Multiple Choice'});
      return list;
    }
  }
}]);

window.onbeforeunload = function() {
  //localStorage.removeItem(key);
  localStorage.clear();
 };