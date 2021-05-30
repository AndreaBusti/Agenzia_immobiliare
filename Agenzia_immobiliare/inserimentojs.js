 function hideAll(){
				$("#errorName").hide();
				$("#errorCogn").hide();
				$("#errorCodFisc").hide();
				$("#errorEmail").hide();
				$("#errorNum").hide();
				$("#errorPiva").hide();
				
			}
            function validateName(){
				var obj=document.getElementById("nome");
				var pattern= /[a-zA-Z]$/;
				if(!pattern.test(obj.value)){
					obj.value=null;
					$("#errorName").show();
					obj.focus();
				}
				else{
					$("#errorName").hide();
				}
			}
            function validateCogn(){
				var obj=document.getElementById("Cognome");
				var pattern= /[a-zA-Z]$/;
				if(!pattern.test(obj.value)){
					obj.value=null;
					$("#errorCogn").show();
					obj.focus();
				}
				else{
					$("#errorCogn").hide();
				}
            function validateCodFisc(){
				var obj=document.getElementById("CodF");
				var pattern= /^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$/;
				if(!pattern.test(obj.value)){
					obj.value=null;
					$("#errorCodFisc").show();
					obj.focus();
				}
				else{
					$("#errorCodFisc").hide();
				}
			}
                    }
            function insCod(str){
                var xmlhttp=new XMLHttpRequest();
                    xmlhttp.onreadystatechange=function(){
                        if(this.readyState == 4 && this.status == 200){
                            document.getElementById("cod").innerHTML=this.responseText;
                        }
                    };
                    xmlhttp.open("GET","sceltaApparizione.php?q="+str,true);
                    xmlhttp.send();
            }
            function insCod2(str){
                var xmlhttp=new XMLHttpRequest();
                    xmlhttp.onreadystatechange=function(){
                        if(this.readyState == 4 && this.status == 200){
                            document.getElementById("cod").innerHTML=this.responseText;
                        }
                    };
                    xmlhttp.open("GET","sceltaApparizione2.php?q="+str,true);
                    xmlhttp.send();
            }
