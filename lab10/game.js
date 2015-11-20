"use strict";
var numberOfBlocks = 9;
var targetBlocks = [];
var trapBlock;
var targetTimer;
var trapTimer;
var instantTimer;

document.observe('dom:loaded', function()
{
	$("start").observe("click", function()
	{
		$("score").innerHTML = "0";
		$("state").innerHTML = "READY";
		
		clearInterval(targetTimer);
		clearInterval(trapTimer);
		clearInterval(instantTimer);
		
		setTimeout(startGame, 3000); //start 3sec
	});
	$("stop").observe("click", stopGame);
});

function startGame()
{
	trapBlock = null;
	targetBlocks = [];
	
	var cnt=0;
	var bl = $$(".block");
	
	while(cnt<=bl.length-1) 
	{
		bl[cnt].removeClassName("trap");
		bl[cnt].removeClassName("target");
		cnt++;
	}
	
	startToCatch();
}

function stopGame()
{
	var cnt=0;
	var bl;
	
	trapBlock = null;
	targetBlocks = [];
	
	$("score").innerHTML = "0";
	$("state").innerHTML = "STOP";
	
	clearInterval(targetTimer);
	clearInterval(trapTimer);
	clearInterval(instantTimer);
	
	bl = $$(".block");
	
	while (cnt<=bl.length-1) 
	{
		bl[cnt].stopObserving();
		cnt++;
	}
}

function startToCatch()
{
	$("state").innerHTML = "CATCH";
	var f_ran, s_ran, result;
	var bl = $$(".block");
	var cnt=0;
	var blk;
	
	targetTimer = setInterval(function()
	{
		f_ran = parseInt(Math.random() * numberOfBlocks);
		
		while(bl[f_ran].hasClassName("target") || bl[f_ran].hasClassName("trap"))
		{
			f_ran = parseInt(Math.random() * numberOfBlocks);
		}
		
		targetBlocks.push(bl[f_ran]);
		bl[f_ran].addClassName("target");

		if(targetBlocks.length >= 5) 
		{
			stopGame();
			$("state").innerHTML = "LOSE";
		}
	}, 1000); //every sec
	
	trapTimer = setInterval(function()
	{
		s_ran = parseInt(Math.random() * numberOfBlocks);
		
		while(bl[s_ran].hasClassName("target"))
		{
			s_ran = parseInt(Math.random() * numberOfBlocks);
		}
		
		trapBlock = bl[s_ran];
		bl[s_ran].addClassName("trap");

		instantTimer = setTimeout(function()
		{
			bl[s_ran].removeClassName("trap");
		}, 2000); //remove 2sec
	}, 3000); //trap 3sec
	
	
	while(cnt<=bl.length-1) 
	{
		bl[i].observe("click", function()
		{
			result = $("score").innerHTML;
			result = parseInt(result);
			
			if(this.hasClassName("trap") == true)
			{
				if (result<=0)
				{
					result=0;
				}
				else 
				{
					result=result-30;
				}
				this.removeClassName("trap");
			}
			else if(this.hasClassName("target") == true)
			{
				if (result>=0)
				{
					result = result+20;				
				}
				
				this.removeClassName("target");
				
				for(var i=0; i<=targetBlocks.length-1; i++)
				{
					if(this == targetBlocks[i])
					{
						targetBlocks.splice(i, 1);
					}
				}
			}
			else if(this.hasClassName("trap") == false && this.hasClassName("target") == false)
			{
				if (result<=0)
				{
					result=0;
				}
				else 
				{
					result = result-10;
				}
				
				this.addClassName("wrong");
				blk = this;
			
				instantTimer = setTimeout(function()
				{
					blk.removeClassName("wrong");
				}, 100); //0.1sec
			}
			
			$("score").innerHTML = result;
		});
		
		cnt++;
	}
}