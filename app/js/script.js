

            var cne = document.getElementById("cne");
            var fil = document.getElementById("fil");
            var ppr = document.getElementById("ppr");
            var cne1 = document.getElementById("cne1");
            var ppr1 = document.getElementById("ppr1");

            
            ppr1.required = true;
            
            
        window.onload = function(){
                cne.style.display='none';   
                fil.style.display='none';
            }

            function hide(){
                var qui = document.getElementById("qui").value;
                if (qui == "Enseignant"){
                    
                    
                    cne.style.display='none';
                    fil.style.display='none';
                    ppr.style.display='';
                    cne1.required = false;
                    
                } else if(qui == "Fonctionnaire") {
                    
                    
                    cne.style.display='none';
                    fil.style.display='none';
                    ppr.style.display='';
                    cne1.required = false;

                }
                else {
                    
                    cne.style.display='';
                    fil.style.display='';
                    ppr.style.display='none';
                    ppr1.required = false;
                    cne1.required = true;
                }
            }

    
            function check() {
                
                var bt = document.getElementById("btSubmit");
                
                
                
            
                if (document.getElementById('password').value ==
                    document.getElementById('c_password').value) {
                    document.getElementById('message').style.color = 'green';
                    document.getElementById('message').innerHTML = 'Mot de passe correct';
                     bt.disabled = false; 
                     document.getElementById("confirmer").disabled = false; 
                } else {
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = "Mot de passe incorrect";
                     bt.disabled = true; 
                                        document.getElementById("confirmer").disabled = true;

                }
                if(document.getElementById('password').value == '' && document.getElementById('c_password').value == '' ){
                    document.getElementById('message').innerHTML = '';
                     bt.disabled = true;
                    document.getElementById("confirmer").disabled = true;

                }
        }

    
       