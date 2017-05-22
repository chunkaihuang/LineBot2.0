require 'sinatra'
require 'sinatra/logger'
require 'line/bot'

class LineBotService

  attr_accessor :client
  def initialize
    self.client ||= Line::Bot::Client.new { |config|
      config.channel_secret = ENV["LINE_CHANNEL_SECRET"]
      config.channel_token = ENV["LINE_CHANNEL_TOKEN"]
    }
  end

  def reply_msg request
    body = request.body.read

    bot = LineBotService.new
    bot.varify_signature(request)

    events = client.parse_events_from(body)
    events.each { |event|
      case event
      when Line::Bot::Event::Message
        case event.type
        when Line::Bot::Event::MessageType::Text

          # 接收訊息後客製化回應訊息
          return_msg = bot.custom_message(event.message['text'])
          # 組成回覆字串
          message = bot.format_message(return_msg)
          # 回覆
          client.reply_message(event['replyToken'], message)

        when Line::Bot::Event::MessageType::Image, Line::Bot::Event::MessageType::Video
          response = client.get_message_content(event.message['id'])
          tf = Tempfile.open("content")
          tf.write(response.body)
        end
      end
    }
    return 'success'
  end

  def format_message return_msg
    {
      type: 'text',
      text: return_msg
    }
  end

  def varify_signature request
    body = request.body.read
    signature = request.env['HTTP_X_LINE_SIGNATURE']
    unless client.validate_signature(body, signature)
      # error 400 do 'Bad Request' end
      return_msg = '400 Bad Request'
      return '400 Bad Request'
    end
  end

  def custom_message receive_message
    rand_num = rand(1..3)

    case receive_message
    when /蛙人/, /蛙人渣/, /陳蛙興/
      case rand_num
      when 1
        "根本是比陳進興那些殺人犯還要不如的爛貨"
      when 2
        '你是覺得你是朱彥碩是不是?想靠嘴巴戰勝別人討口飯吃?'
      when 3
        '阿鄙無言停 閻羅王打來說叫你快回到地獄去 一來不要在人世間繼續陷害無辜的人 二來地獄有新的絞刑處決罪惡極重 罪大惡性的人渣 快回去吧 快點喔'
      end
    when /蔡竣宇/, /俊宇/, /小護士/
      case rand_num
      when 1
        '這個人整個人的觀念出了非常大的問題'
      when 2
        '是無藥可救詐欺犯詐騙集團首領卑鄙小人'
      when 3
        '你們可以自己仔細思考看看，他的這種惡劣行為大概比殺人在緩和一點而已！'
      end
    when /高果/, /中華電信/
      case rand_num
      when 1
        '我的耳機勒???'
      when 2
        '是喔...都已經動情了....不能認識喔...'
      when 3
        '高果可不可以就是...那個就是...'
      end
    when /大餅/, /吳秉勳/, /大塊餅乾/
      case rand_num
      when 1
        '吳秉勳還說啥他考試都不會作弊啊!!!!幹 噁心噁爛'
      when 2
        '考試要我罩他 抄我答案 還可以在背後捅我 亂酸我網誌'
      when 3
        "吳__勳23歲廢物雙面千面人 專長:唯恐天下不亂搬弄是非誹謗人讓人與人之間失去信任吃女生豆腐亂摸女生裝熟戴一大堆面具騙人到處背後桶別人刀用負面的情緒自以為講話幽默花言巧語滿口謊言八卦別人隱私讓人狗咬狗作了弊又裝作清高到處說自己不會作弊心機超重心眼心胸狹小無比自以為講話中懇陷害別人"
      end
    when /我媽/, /媽媽/
      case rand_num
      when 1
        '連我媽都酸都頂撞'
      when 2
        '惹火我媽這當然不能原諒'
      when 3
        "誰弄到你媽你會放過？"
      end
    when /時候/, /真心/, /體會/, /感受/
      "每當這個時候 只要想起 絕不讓真心對自己的人失望 就覺得時時刻刻都是希望 用心去體會 感受"
    when /好久不見/
      case rand_num
      when 1
        '蛙人: 
        
    好久不見阿，這封信是要寫給你的，對你非常抱歉，對不起。很謝謝你。很懷念以前大一一起相處的時光，很謝謝你以前的關照與幫忙，大一幫忙我很多，幫過我印講義，騎車載我跟高果去醫院，讓同學一起玩你的XBOX360電動，對朋友總是大方與第一優先，把最好的都給朋友，自己選擇次要的。重感情，是我們長庚資管這屆的風格風氣，在我感受到下一屆那令人火大與討厭的屁孩騷擾與嗆聲，我才了解到當初為何你跟大餅會這麼不爽學弟，程本仁、羅淮耀、陳揚叡(自以為盧廣仲的)，他們是物以類聚的屁孩，共同點就是很自我中心很囂張沒在尊重別人的，我這次被羅淮耀騷擾與過河拆橋還被他當面嗆聲後，我完全感受到了。跟羅淮耀的指導教授說明 羅淮耀當面嗆"過河拆橋"這四個字，真的是史無前例的囂張屁孩。Anyway，過去我有些缺點，很謝謝也很抱歉你跟高果對我的包容與容忍，盧洨、很煩、跳針、麻煩你們幫小事情等等，隨著年紀增長以及遇到一些事情與挫折，慢慢的經歷與改變。以前會不爽，都是我個性缺點我自己的問題，我思考過，我鑽牛角尖，自己沒做好或煩到你們被講話，但自己面子掛不住就覺得怎這樣講我壞話。親身發生過一些事情(EX:羅淮耀裝熟事件)能體會到以前你們受害者的不舒服。這封信希望能讓你舒服，希望還能像過去一樣朋友，有空有緣見面聊天，我也很想幫助你，不管工作、還是任何困難等等，希望你跟大餅都一樣，話說Kobe要退休了，時間好快也很捨不得。系運回去大家再見面吧。謝拉。

        大菜'
      when 2
        '蛙人: 
        
    好久不見阿，這封信是要寫給你的，對你非常抱歉，對不起。很謝謝你。








    你以為我每次都會打完？'
      when 3
        '蛙人: 
        
    好久不見阿






你是覺得你是朱彥碩是不是?
    '
      end
    when /小牛/, /胡至豪/, /紅寶/, /主任/
      case rand_num
      when 1
        '帥帥的 沒缺點'
      when 2
        '只要學習 小牛的人格特質 就很棒拉'
      when 3
        ''
      end
    else
      ''
    end
  end
end
