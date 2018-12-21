
let a = 1, b = 1; // начальные значения
let d;
d = a + b; // 2




function fib(n) {
    let a = 1,
        b = 1,
        c;
    for (let i = 3; i <= n; i++) {
         c = a + b;
        a = b;
        b = c;
    }
    return b;
}

alert( fib(3) );
alert( fib(7) );
alert( fib(77) );