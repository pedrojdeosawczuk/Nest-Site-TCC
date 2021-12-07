var clk=0;
function mostra(theId){
	var theArray= new Array('item1', 'item2', 'item3', 'item4', 'item5', 'item6', 'item7', 'item8');
	if(clk==0){
		for(i=0; i<theArray.length; i++){
			if(theArray[i] == theId){
				document.getElementById(theId).style.display='block';
			}else{
				document.getElementById(theArray[i]).style.display='none';
			}
		}
		clk++;
	}else if(clk==1){
		document.getElementById(theId).style.display="none";
		clk=0;
	}
}