var express = require("express");
var app     = express();
var path    = require("path");
var formidable = require('formidable');
var fs = require('fs');
var PDFParser=require('pdf2json');
var mysql = require('mysql');
var bodyParser = require('body-parser');
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "internship"
});
app.get('/',function(req,res){
  res.sendFile(path.join(__dirname+'/index.html'));
});
app.post('/fileupload',function(req,res){

        var form = new formidable.IncomingForm();
        form.parse(req, function (err, fields, files) {
          var oldpath = files.filetoupload.path;
          var newpath = path.join( __dirname+'/upload/'+ files.filetoupload.name);
         
          var fname = files.filetoupload.name;
          var fsize = files.filetoupload.size;
          var ftype = files.filetoupload.type;
         // console.log(files.filetoupload);
          //using pdf parser 
          /*
          let pdfParser = new PDFParser();
 
    pdfParser.on("pdfParser_dataError", errData => console.error(errData.parserError) );
    pdfParser.on("pdfParser_dataReady", pdfData => {
      fs.writeFile("./F1040EZ.content.txt", pdfParser.getRawTextContent());
       // console.log(JSON.stringify(pdfData));
    });
    fs.readFile(oldpath, (err, pdfBuffer) => {
      if (!err) {
        pdfParser.parseBuffer(pdfBuffer);
      }
    })*/

          fs.readFile(oldpath, {encoding: 'utf-8'}, function(err,data){
            if (!err) {
             //   console.log('received data: ' + data.toString());
             var data1= data.toString();
                res.writeHead(200, {'Content-Type': 'text/html'});
                con.connect(function(err) {
                  if (err) throw err;
                  var sql = "INSERT INTO filestore ( filetext, fname , fsize , ftype) VALUES ('"+fname+"','"+fname+"','"+fsize+"','"+ftype+"')";
                  con.query(sql, function (err, result) {
                    if (err) throw err;
                    console.log("1 record inserted");
                    
                  });
                  });
              fs.copyFile(oldpath, newpath, function (err) {
                if (err) throw err;
                console.log('File uploaded and moved!');
               
              });

             
           
                //res.render('index.html');
            } else {
                console.log(err);
            }
        });
        
        
 });   
})
app.get('/filedownload',function(req,res){

 con.connect(function(err) {
    if (err) throw err;
    var sql = "SELECT * from filestore";
    con.query(sql, function (err, result) {
      if (err) throw err;
      console.log("datafeteched ");
     // console.log(result);
        var j=-1;
      for(i in result){
        j++;
      }
      var fname= result[j].fname;
      console.log(fname);
       
      res.download( __dirname+'/upload/'+fname,fname);
    
    });
      
    });
    });
    


   
})
app.listen(3000);
console.log("Running at Port 3000");