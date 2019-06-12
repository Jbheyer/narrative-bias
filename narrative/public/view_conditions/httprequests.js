function ajaxRequest(textValue, type, theme, resultURL, updateURL) {

    console.log("ajaxRequest",textValue,type,theme,resultURL,updateURL);
    if(textValue.length > 0){

        $.ajax({
            type: "POST",
            url: updateURL,
            data:{
                'interactionText': textValue,
                'type': type,
                'theme': theme},
            success: function(data, textStatus, xhr) {
                console.log(data);
                if(data.indexOf('success') >= 0) { // if true (1)
                    setTimeout(function(){// wait for 5 secs(2)
                        location.href = resultURL; // then reload the page.(3)
                    }, 100);
                }
                else{
                    alert("Database Error")
                    //location.href = 'user.php';

                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(textStatus.reponseText);
            }
        });
    }
    else{
        alert("Please enter your MTruk ID to continue");
    }
}


function ajaxRequestPredict(textValue, predictValue1, predictValue2, type, theme, resultURL, updateURL) {

    console.log("ajaxRequest",predictValue1,predictValue2,textValue,type,theme,resultURL,updateURL);
    if(textValue.length > 0){
        console.log(isNaN(predictValue1),isNaN(predictValue2))
        if(isNaN(predictValue1)==true)
            if(predictValue1.indexOf("%") != -1)
            {
                predictValue1 = predictValue1.substring(0,predictValue1.length-1)
            }

        if(isNaN(predictValue2)==true)
            if(predictValue2.indexOf("%") != -1)
                {
                     predictValue2 = predictValue2.substring(0,predictValue2.length-1)
                }

        $.ajax({
            type: "POST",
            url: updateURL,
            data:{
                'predictValue1':predictValue1,
                'predictValue2':predictValue2,
                'interactionText': textValue,
                'type': type,
                'theme': theme},
            success: function(data, textStatus, xhr) {
                console.log(data);
                if(data.indexOf('success') >= 0) { // if true (1)
                    setTimeout(function(){// wait for 5 secs(2)
                        location.href = resultURL; // then reload the page.(3)
                    }, 100);
                }
                else{
                    alert("Database Error")
                    //location.href = 'user.php';

                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(textStatus.reponseText);
            }
        });
    }
    else{
        alert("Please enter your MTruk ID to continue");
    }
}

(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };
}(jQuery));

setInputFilter(document.getElementById("pred2"), function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 99); });

setInputFilter(document.getElementById("pred1"), function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 99); });