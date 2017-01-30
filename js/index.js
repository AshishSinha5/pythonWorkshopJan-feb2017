$(document).ready(function(){
    
    //on click of register
    $(document).on('click','#register',function(e){
        e.preventDefault();//to prevent submit
        var regno= $("#regno").val();
        var name= $("#name").val();
        var course= $("#course").val();
        var semester= $("#semester").val();
        var email= $("#email").val();
        var mobile= $("#mobile").val();
        var info={regno : regno , name: name , course:course , semester:semester , email:email , mobile:mobile}; //forming json string 
        info =JSON.stringify(info); //in php7.0 its necessary earlier it wasn't needed
       // alert(info);
        sendToRegister(info);
    });
    
    //on click of attendance submit
    $(document).on('click','#submit',function(e){
        e.preventDefault();
        var regno=$("#regnoForAttendance").val();
        var info={regno:regno};
        info =JSON.stringify(info);
       // alert(info);
        sendToAttendance(info);
    });
    $(document).on('click',"#feedsubmit",function(e){
        e.preventDefault();
        var regno=$("#regnoForFeedback").val();
        var text=$("#text").val();
        var info={regno:regno , text: text};
        info =JSON.stringify(info);
        //alert(info);
        sendToFeedback(info);
    });
});
var sendToRegister=function(info){
       $.ajax({
        url: "register.php",
        type:"post",
        data:info,
        async: true,  //make it false if you send data to php and reload page else keep i true
        success: function (response) {
		//alert(response);   //result from server or php file if successjsondata=$.parseJSON(response); //to json object
                jsondata=$.parseJSON(response); //to json object
                if(jsondata.error){
                   alert(jsondata.error)
                }else if(jsondata.msg){
                alert(jsondata.msg) //showing using . operator 
                //we can also use it as associative array jsondata['name']
                }
        },
        error: function (response, status, errorThrown) {
            console.log(response.status);
            alert(response) ; //result from server if error occured
            alert(errorThrown);  //error code
        },
        cache: false,
        contentType: false,
        processData: false
    });
};

var sendToAttendance=function(info){
    $.ajax({
       url:"attendance.php",
       type:"post",
       data:info,
       async:true,
       success:function(response){
           // alert(response);
            jsondata=$.parseJSON(response); //to json object
                if(jsondata.error){
                   alert(jsondata.error)
                }else if(jsondata.msg){
                alert(jsondata.msg) //showing using . operator 
                //we can also use it as associative array jsondata['name']
                }
       },
       error:function(response,status,errorThrown){
            console.log(response.status);
            alert(response);
            alert(errorThrown);
       },
       cache:false,
       contentType:false,
       processData:false
    });
};
var sendToFeedback=function(info){
    $.ajax({
       url:"feedback.php",
       type:"post",
       data:info,
       async:true,
       success:function(response){
           // alert(response);
            jsondata=$.parseJSON(response); //to json object
                if(jsondata.error){
                   alert(jsondata.error)
                }else if(jsondata.msg){
                alert(jsondata.msg) //showing using . operator 
                //we can also use it as associative array jsondata['name']
                }
       },
       error:function(response,status,errorThrown){
            console.log(response.status);
            alert(response);
            alert(errorThrown);
       },
       cache:false,
       contentType:false,
       processData:false
    });
};
