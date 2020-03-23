$(document).ready(function() {
  
  // A database of the symbols and functions of every operand. Order of operators determines precedence.
  var operators = [
    {
      id: "op-negate",
      numOperands: 1,
      symbol: " -",
      calc: function(a) {
        return -a;
      }
    },
    {
      id: "op-multiply",
      numOperands: 2,
      symbol: " x ",
      calc: function(a, b) {
        return a * b;
      }
    },
    {
      id: "op-divide",
      numOperands: 2,
      symbol: " ÷ ",
      calc: function(a, b) {
        return a / b;
      }
    },
    {
      id: "op-add",
      numOperands: 2,
      symbol: " + ",
      calc: function(a, b) {
        return a + b;
      }
    },
    {
      id: "op-subtract",
      numOperands: 2,
      symbol: " - ",
      calc: function(a, b) {
        return a - b;
      }
    }
  ];
  
  // The number of places to round to
  const roundPlaces = 8;
  
  // Get the operator object for a given operator ID
  function getOperator(opID) {
    for(var i = 0; i < operators.length; i++) {
      if(operators[i].id === opID) {
        return operators[i];
      }
    }
    return undefined;
  }
  
  // Get the precedence of an operator given its ID
  function getOpPrecedence(opID) {
    for(var i = 0; i < operators.length; i++) {
      if(operators[i].id === opID) {
        return i;
      }
    }
    
    // If the given ID does not return an operator, then return a large value that will always lose in precedence
    return 1000000;
  }
      
  // Returns true if op1 ID has equal or higher precedence than op2 ID, false otherwise
  function hasPrecedence(op1, op2) {
    if(getOperator(op1) != undefined) {
      return getOpPrecedence(op1) <= getOpPrecedence(op2);
    }
  }
    
  // A list of every token (number or operator) currently in the expression
  var tokenList = [];
  
  // A list of previous results and expressions in the form {out: output, expression: expression string, tokens: list of tokens in the expression}
  var calcHistory = [];
  
  // Evaluates the expression and outputs the result
  function calculate() {
    // Check if brackets are balanced
    var count = 0;
    for(var i = 0; i < tokenList.length; i++) {
      if(tokenList[i] === "bracket-left") {
        count++;
      } else if(tokenList[i] === "bracket-right") {
        count--;
      }
    }
    if(count != 0) {
      output("Error: unbalanced brackets");
      return;
    }
    
    // Evaluate the expression using a modified version of the shunting yard algorithm
    var valStack = [];
    var opStack = [];
    
    for(var i = 0; i < tokenList.length; i++) {
      if(!isNaN(tokenList[i])) {
        valStack.push(tokenList[i]);
      } else {
        while(opStack.length > 0 && hasPrecedence(opStack[opStack.length - 1], tokenList[i])) {
          var operator = getOperator(opStack.pop());
          if(operator.numOperands === 1)
            valStack.push(applyOperator(operator, [valStack.pop()]));
          else
            valStack.push(applyOperator(operator, [valStack.pop(), valStack.pop()]));
        }
        opStack.push(tokenList[i]);
      }
    }
    
    while(opStack.length > 0) {
      var operator = getOperator(opStack.pop());
      if(operator.numOperands === 1)
        valStack.push(applyOperator(operator, [valStack.pop()]));
      else
        valStack.push(applyOperator(operator, [valStack.pop(), valStack.pop()]));
    }
    
    // Output the calculated result and the original expression
    output(valStack[0], $("#expression").html(), tokenList);
	var res = valStack[0];
	var expr= $('#expression').val();
	var message= expr + " = " + res;
	$.ajax({
		data: {message:message},
		type:"post",
		url:"insertcalc.php",
	})
  }
  
  // Returns the result of applying the given unary or binary operator on the top values of the value stack
  function applyOperator(operator, vals) {
    var valA = vals[0];
    var result;
    
    if(vals.length === 1) {
      result = operator.calc(parseFloat(valA));
    } else {
      var valB = vals[1];
      result = operator.calc(parseFloat(valB), parseFloat(valA));
    }

    return result;
  }
  
  // Updates the equation and calc history with the given output
  function output(out, expression, tokens) {
    out = +out.toFixed(roundPlaces);
    $("#expression").html(out.toString());
    var hist=expression + " = " + out;
	    calcHistory.push({out: out, expression: expression, tokens: tokens});
    $("#calc-history-box").html("");
    for(var i = calcHistory.length - 1; i >= 0; i--) {
      $("#calc-history-box").append("<p" + i + "'>" + calcHistory[i].expression + " = " + calcHistory[i].out + "</p>");
    }
  }
  
  // Adds a token to the token list and updates the display
  function addToken(token) {
    if(isNaN(token)) {
      if((token === "bracket-left") && !isNaN(tokenList[tokenList.length - 1])) {
        tokenList.push("op-multiply");
      }
      tokenList.push(token);
    } else {
      if(!isNaN(tokenList[tokenList.length - 1])) {
        tokenList[tokenList.length - 1] = tokenList[tokenList.length - 1] + token;
      } else {
        if(!isNaN(token) && (tokenList[tokenList.length - 1] === "bracket-right")) {
          tokenList.push("op-multiply");
        }
        tokenList.push(token);
      }
    }
        
    displayEquation();
  }

  // Updates the expression display's HTML
  function displayEquation() {
    var htmlString = "";
    for(var i = 0; i < tokenList.length; i++) {
      if(isNaN(tokenList[i])) {
        {
          htmlString += getOperator(tokenList[i]).symbol;
        }
      } else {
        htmlString += tokenList[i];
      }
    }
    $("#expression").html(htmlString);
  }
  
  // Deletes the last entered token
  function deleteLast() {
    if(isNaN(tokenList[tokenList.length - 1])) {
      tokenList.pop();
    } else {
      tokenList[tokenList.length - 1] = tokenList[tokenList.length - 1].slice(0, -1);
      if(tokenList[tokenList.length -1].length === 0) {
        tokenList.pop();
      }
    }
    
    displayEquation();
  }
   
  // Triggers the appropriate action for each button that can be pressed
  function processButton(button) {
    switch($(button).attr("id")) {
      case "delete":
        deleteLast();
        break;
      case "clear":
        if(tokenList.length === 0) {
          calcHistory.length = 0;
          $("#calc-history-box").html("");
        } else {
          tokenList.length = 0;
          displayEquation();
        }
        break;
      case "period":
        if(isNaN(tokenList[tokenList.length - 1])) {
          addToken("0.");
        } else {
          if(tokenList[tokenList.length - 1].indexOf(".") === -1) {
            tokenList[tokenList.length - 1] += ".";
          }
        }
        displayEquation();
        break;
      case "equals":
        calculate();
        break;
      default:
        if($(button).hasClass("num")) {
          addToken($(button).html());
        } else {
          addToken($(button).attr("id"));
        }
    }
  }
  
  // Catches all button clicks on the page
  $(".btn").click(function(event) {
    $(event.target).blur();
    processButton(event.target);
  });
  
  
  
});
