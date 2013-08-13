var http, expess, path, app;

http    = require("http");
express = require("express"),
path    = require("path"),
app     = express();

app.set('port', process.env.PORT || 3000);
app.use(express.static(path.join(__dirname, 'public')));

app.get("/", function (request, response) {
   response.sendfile( __dirname + "/public/index.html");
});

http.createServer(app).listen(app.get('port'), function(){
  console.log('We be listening here on port : ' + app.get('port'));
});