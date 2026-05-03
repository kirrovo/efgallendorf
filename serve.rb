require 'webrick'
root = '/Users/levi/Desktop/Claude/Websites/EFG Allendorf'
server = WEBrick::HTTPServer.new(
  Port: 3001,
  DocumentRoot: root,
  Logger: WEBrick::Log.new('/dev/null'),
  AccessLog: []
)
trap('INT') { server.shutdown }
server.start
