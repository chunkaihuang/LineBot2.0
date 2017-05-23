require 'sinatra'   # gem 'sinatra'
require 'line/bot'  # gem 'line-bot-api'

def client
  @client ||= Line::Bot::Client.new { |config|
    config.channel_secret = ENV["LINE_CHANNEL_SECRET"]
    config.channel_token = ENV["LINE_CHANNEL_TOKEN"]
  }
end

def det_key_word(rec_word)
  
  case rec_word
  when "尼尼"
    "老婆~"
  when "蛙人"
    "我不是蛙人"
  when "大餅"
    "我也不是大餅啦"
  else
    if rec_word.include?('蛙人')
      "誰叫誰蛙人"
    elsif rec_word.include?('是不是')  
      "你是呀"
    elsif rec_word.include?('會不會')
      "你變給我看呀"
    elsif rec_word.include?('像你')
      "像帥吧叭"   
    elsif rec_word.include?('臭')
      "你綴臭"   
    elsif rec_word.include?('小只')
      "你小只的"     
    else  
      "你好我是黃肯尼"
    end  
  end  
end  

def reply_msg
  body = request.body.read

  signature = request.env['HTTP_X_LINE_SIGNATURE']
  unless client.validate_signature(body, signature)
    error 400 do 'Bad Request' end
  end

  events = client.parse_events_from(body)

  events.each { |event|
    case event
    when Line::Bot::Event::Message
      case event.type
      when Line::Bot::Event::MessageType::Text
        message = {
          type: 'text',
          text: det_key_word(event.message['text'])
        }
        client.reply_message(event['replyToken'], message)
      end
    end
  }
end

post '/callback' do
  reply_msg
end

