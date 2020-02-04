var fs = require('fs');

var files = [{
    input: 'input/a_example.in',
    output: 'output/a_example.out'
  },
  {
    input: 'input/b_small.in',
    output: 'output/b_small.out'
  },
  {
    input: 'input/c_medium.in',
    output: 'output/c_medium.out'
  },
  {
    input: 'input/d_quite_big.in',
    output: 'output/d_quite_big.out'
  },
  {
    input: 'input/e_also_big.in',
    output: 'output/e_also_big.out'
  }
]

files.forEach(file => {
  fs.readFile(file.input, function (err, data) {
    if (err) throw err;

    var lines = data.toString('utf-8').split("\n");

    var line_1 = lines[0].split(' ');

    var maxsize = parseInt(line_1[0], 10);
    var pTypes = parseInt(line_1[1], 10);
    var input = lines[1];

    var output = pizza(maxsize, pTypes, input);

    fs.writeFileSync(file.output, `${output.length}\r\n${output.join(' ')}`);

  })
});

function pizza(maxsize, pTypes, input) {

  /*
  var maxsize = 1000000000;
  var pTypes = 2000;
  var input = "";
  */
  var pTypeArr = input.split(' ').map(x => parseInt(x, 10));

  var sum = 0;
  var sumArr = [];
  var final = [];

  while (pTypeArr.length) {

    // console.log(pTypeArr.length);

    var largest = pTypeArr[pTypeArr.length - 1];
    sum += largest;

    if (sum < maxsize) {
      final.push(pTypeArr.length - 1);
    } else {
      sum -= largest;
    }

    pTypeArr.pop();
  }

  return final;
}