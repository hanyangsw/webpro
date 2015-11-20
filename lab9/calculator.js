"use strict"
var stack = [];
window.onload = function () 
{
    var displayVal = "0";
	var expressVal = "";
	var chk = false;

	for (var i in $$('button')) 
	{
        $$('button')[i].onclick = function () 
		{
			var value = $(this).innerHTML;
			
			if (value == "AC")
			{
				stack = [];
				displayVal = "0";
				expressVal = "0";
				$('result').innerHTML = "0";
				$('expression').innerHTML = "0";
				chk = false;
			}
			else if (/^[0-9]+$/.test(value))
			{
				if (chk == false)
				{
					if (displayVal[0] == "0") 
					{
						displayVal = value;
					}
					else 
					{
						displayVal = displayVal + value;
					}

					if (document.getElementById('expression').innerHTML[0]=="0") 
					{
						document.getElementById('expression').innerHTML = displayVal;
					}
					else 
					{
						document.getElementById('expression').innerHTML += value;
					}
				}
			}
			else if (value == ".")
			{	
				if (chk == false)
				{
					if (displayVal.indexOf(".") < 0) 
					{
						displayVal = displayVal + ".";
					} 
						
					if (document.getElementById('expression').innerHTML[0]=="0") 
					{
						document.getElementById('expression').innerHTML = displayVal;
					}
					else 
					{
						document.getElementById('expression').innerHTML += value;
					}	
				}				
			}
			else if ((value == "(" || value == ")"))
			{
				if (chk == false)
				{
					if ((value == "(") && (displayVal != "0"))
					{
						stack.push(parseFloat(displayVal));
						stack.push("*");
						displayVal = "0";
					}
					else if (value == ")")
					{
						 stack.push(parseFloat(displayVal));
					}
					
					stack.push(value);

					if (document.getElementById('expression').innerHTML[0]=='0') 
					{
						document.getElementById('expression').innerHTML = value;
					}
					else 
					{
						document.getElementById('expression').innerHTML += value;
					}
					displayVal = "0";
				}
			}
			else
			{
				if (chk == false) 
				{
                    if (displayVal != "0") 
					{
                        if (stack[stack.length-1] == ")") 
						{
                            stack.push("*");
                        }
                        stack.push(parseFloat(displayVal));
                    }
                    
                    document.getElementById('expression').innerHTML += " " + value + " ";

                    displayVal = "0";
                    
                    if (value == "=")
					{
                        if (isValidExpression(stack))
						{
                            stack = infixToPostfix(stack);
                            displayVal = postfixCalculate(stack);
							
                            if (isNaN(displayVal)) 
							{
                                chk = true;
                            }
                            else 
							{
                                document.getElementById('expression').innerHTML += " " + displayVal;
                            }
                        }
                        else 
						{
                            chk = true;
                        }
                    } 
					else 
					{
                        stack.push(value);
                    }
                }
			}
			
			$('result').innerHTML = displayVal;
        };
    }
}

function isValidExpression(s) 
{
	var stk1 = [];
	
	for (var i=0; i<s.length; i++) 
	{
        if (s[i] == "(")
		{
            stk1.push("(");
        }
        else if (s[i] == ")")
		{
            if (stk1.length == 0)
			{
                return false;
			}
			
            var t = stk1.pop();
            if (t == "(" && s[i] != ")")
            {
				return false;
			}
        }
    }
    return true;
}

function postfixCalculate(s) 
{
	var data1; 
	var data2;
    var cal;
    var stk2 = [];
	
    for (var i=0; i<s.length; i++)
	{
        if (!isNaN(s[i]))
		{
            stk2.push(s[i]);
        }
        else 
		{
            data1 = stk2.pop();
            data2 = stk2.pop();
            
            if (s[i] == "+")
			{	
				cal = data1+data2;
			}
			else if (s[i] == "-")
			{
				cal = data2-data1;
			}
			else if (s[i] == "*")
			{
				cal = data1*data2;
			}
			else if (s[i] == "/")
			{
				cal = data1/data2;
			}	
			stk2.push(cal);
        }
    }
    return stk2.pop();
}

function infixToPostfix(s) 
{
    var priority = {
        "+":0,
        "-":0,
        "*":1,
        "/":1
    };
    var tmpStack = [];
    var result = [];
	
    for(var i =0; i<stack.length ; i++) {
        if(/^[0-9]+$/.test(s[i])){
            result.push(s[i]);
        } else {
            if(tmpStack.length === 0){
                tmpStack.push(s[i]);
            } else {
                if(s[i] === ")"){
                    while (true) {
                        if(tmpStack.last() === "("){
                            tmpStack.pop();
                            break;
                        } else {
                            result.push(tmpStack.pop());
                        }
                    }
                    continue;
                }
                if(s[i] ==="(" || tmpStack.last() === "("){
                    tmpStack.push(s[i]);
                } else {
                    while(priority[tmpStack.last()] >= priority[s[i]]){
                        result.push(tmpStack.pop());
                    }
                    tmpStack.push(s[i]);
                }
            }
        }
    }
    for(var i = tmpStack.length; i > 0; i--){
        result.push(tmpStack.pop());
    }
    return result;
}
