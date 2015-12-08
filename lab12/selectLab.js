"use strict";

document.observe("dom:loaded", function() {
	/* Make necessary elements Dragabble / Droppables (Hint: use $$ function to get all images).
	 * All Droppables should call 'labSelect' function on 'onDrop' event. (Hint: set revert option appropriately!)
	 * 필요한 모든 element들을 Dragabble 혹은 Droppables로 만드시오 (힌트 $$ 함수를 사용하여 모든 image들을 찾으시오).
	 * 모든 Droppables는 'onDrop' 이벤트 발생시 'labSelect' function을 부르도록 작성 하시오. (힌트: revert옵션을 적절히 지정하시오!)
	 */
	var labimg = $$("#labs img");
	var $i=0;
	
	while($i<labimg.length)
	{
		 new Draggable(labimg[$i], {revert: true});
		 $i++;
	}
	  
	Droppables.add("labs",  {onDrop: labSelect });	  
	Droppables.add("selectpad",  {onDrop: labSelect });
});

function labSelect(drag, drop, event) 
{	
	/* Complete this event-handler function 
	 * 이 event-handler function을 작성하시오.
	 */
	if(drop.id == "selectpad")
	{
		var $selib = $$("#selection li");
		var $tf = true; 
		var $j = 0;
		
		while ($j<$selib.length)
		{
			if(drag.alt == $selib[$j].childNodes[0].innerHTML)
			{
				$tf=false;
			}
			$j++;
		}
		
		if($tf)
		{
			var selimg = $$("#selectpad img").length;
			
			if(selimg < 3)
			{
				var labimg = $$("#labs img");
				var $j = 0;
				
				while($j<labimg.length)
				{
					if(drag.alt == labimg[$j].alt)
					{				
						document.createElement("img");
						labimg[$j].remove();
					}
					$j++;
				}
				
				var docimg = document.createElement("img");
				var li = document.createElement("li");
				var p = document.createElement("p");
				var img = document.createElement("img");
				docimg=drag;
				document.getElementById("selectpad").appendChild(docimg);
				
				new Draggable(docimg, {revert: true});
				
				img.src=drag.src;
				img.alt=drag.alt;
				p.innerHTML = drag.alt;
				li.appendChild(p);
				li.appendChild(img);
				
				document.getElementById("selection").appendChild(li);
				
				setTimeout(function() {
					li.pulsate({ duration: 1.0, pulses: 2});
				}, 500);
			}
		}
	}
	else
	{
		var selimg = $$("#selectpad img");
		var $k = 0;
		
		while($k<selimg.length)
		{
			if(drag.alt == selimg[$k].alt)
			{
		
				document.createElement("img");
				selimg[$k].remove();
			}
			$k++;
		}
		
		var docimg = document.createElement("img"); 
		docimg = drag;
		document.getElementById("labs").appendChild(docimg);
		
		new Draggable(docimg, {revert: true});
		
		var $selib = $$("#selection li");
		var $k = 0;
		
		while($k<$selib.length)
		{
			if(drag.alt == $selib[$k].childNodes[0].innerHTML)
			{

				$selib[$k].remove();
			}
			$k++;
		}
	}
}

