# 初探與分析 政府開放資料"我還想要"平臺
# Basic Research and Analyze in Taiwan Government Open Data Suggestion Platform
## 呂瑞麟指導教授、洪啟恆     國立中興大學資訊管理學系
 
### 摘要  
Open Data開放資料 是現今社會中越來越受到重視的一項資源，政府也跟上了趨勢，建立了政府資料開放平臺(http://data.gov.tw/) ，提供了許多的資料供國民下載。除此之外更推出了"我還想要"專區，讓民眾可以主動向政府提出需求，讓政府資料開放平臺更符合開放資料的本意，開放性。透過這個平臺，我們不在需要被動地等待政府公布我們所需要的資料，反之我們可以主動索取我們需要的資訊，幫助不管是我們的生活，或是研究。此專案即是對政府開放資料平臺的“我還想要”平臺做兩部分的分析與應用。第一部分為針對目前民眾所提出的需求做出分析，了解民眾的需求，並分析各個政府機關的回應效率，以達到了解需求和監督政府的目的。第二部分為透過文字探勘分析民眾需求的文字內容，抓出關鍵字，進而找出該需求建議應該分配的機關，達到節省人力和提高效率的目的。   
關鍵字：開放資料, 文字探勘

### Abstract  
Open data is a resource that have been paid a lot of attention recently in the society, Taiwan government has caught up the trends and create the Government Open Data Platform, which provides numerous data for people to download. Furthermore, Taiwan government set up a ‘suggestion site’ for the masses to ask for the data they need, which made the Government Open Data Platform meets the original idea, open. Through the platform, we don’t need to wait for government to share the information that we need passively, on the contrary, we can voluntarily ask for the information that we need, and use it not only in our life and also in researches. This project process two parts of analyze and apply about the ‘suggestion site’. In the first part we calculated the suggestions people proposed in order to understand the people’s need, and also we calculated the time every organization took to reply suggestions to supervise the government. In the second part we analyze the people’s suggestion by using text mining, select the keywords in the suggestions, trying to find out the organization every suggestion correspond to, for the purpose of saving time and human resource that spent on assigning every suggestion and also improve the efficiency.  
Keywords: Open Data, text mining

1. 動機與目的  
開放資料(Open Data) 為一種能被任何人自由的使用與散布之資料種類，是為了能讓資料能被廣泛且自由的使用，讓資料所能發揮的效益可以最大化而推出的概念。自從美國政府於2009年建立了開放資料網站分享開放資料開始，各國政府也紛紛效法推出自身的開放資料平臺分享開放資料，台灣也不例外。我國行政院於2012年通過院會決議，開始推動國內政府開放資料，並於日後建立了政府資料開放平臺(http://data.gov.tw)，逐步將資料公布於政府資料開放平臺上，提供人民下載使用。
近年來，開放資料除了受到政府的重視之外，國人也逐漸了解到開放資料的方便性與重要性。因此，政府為了讓人民可以取得所需要的資料，在政府資料開放平臺上建立了“我還想要”專區，讓人民主動向政府提出需求，使政府所提出之開放資料更符合人民需求，讓開放資料更符合開放公開的本意。此專題的第一部分即為對於人民所提出的需求透過基本的統計作出分析，了解人民的需求取向。除此之外也針對政府資料開放平臺回覆民眾需求的速度和效率，各機關開放資料的速度和效率作出統計和分析，以了解政府各部門的行政效率，達到監督政府行政的目的。
在經過第一部分的統計後，我們發現在人民提出需求後，“我還想要”專區花費了許多的時間在將人民的需求作分類並指派給對應處理的機關，如此透過人力分析造成了許多的時間浪費和人力耗損。因此我們想到如果能利用程式語言，分析民眾提出需求中的用詞遣字來找出其中的關鍵字，透過關鍵字來比對出需求對應的處理機關，如此一來便能透過這個程式達到節省人力和提高效率的目的，讓民眾可以在最短的時間內更快速的取得想要的開放資料。

2. “我還想要”平臺介紹  
“我還想要”平臺(data.gov.tw/suggest_page) ，如圖一所示，為政府資料開放網站上所提供的一個服務平臺，讓民眾可以主動的向政府要求開放需要的資料。除此之外也可以讓民眾看到其他人建議開放之資料。在向“我還想要”平臺提出建議時會需要填寫建議資料及名稱、建議開放的欄位、建議原因，如圖二所示。在向平臺提出建議後，會先由政府資料開放服務平臺營運團隊回覆，告知建議者已收到建議，並告知建議者政府資料開放服務平臺營運團隊將此建議分派給哪一個負責的機關來處理，日後再由負責處理的機關回覆建議者後續處理的狀況，如圖三所示。

3. 系統建置  
3.1系統架構 
	我們將這個專題分為兩大部分，第一部分主要為針對“我還想要”平臺上面的資訊做整理。針對目前民眾所提出的需求做出分析，了解民眾的需求，並分析各個政府機關的回應效率，以達到了解需求和監督政府的目的。並以網頁的方式將資料結果呈現給使用者。
	第二部分則是透過目前已經有的資料，分析每筆建議內的關鍵字，並找出關鍵字與該建議內容的對應機關之間的關係。並期望日後當有新進資料時可以透過建立起的資料庫替建議資料找出其對應的機關。

3.2 應用技術  
	網頁部分主要由HTML和PHP組成，配合JavaScript、CSS、Bootstrap、MySQL和CanvasJS來將資訊呈現給使用者。程式主要以Java為基礎，利用到Google 開發的JSON Simple來解譯JSON檔案，並透過MMSEG、CKIP、Weka等資源來完成關鍵字的抓取和分析。

3.2.1 Bootstrap  
	Bootstrap為Mark Otto和Jacob Thornton在2011年推出的套件，他整合了HTML、CSS、JavaScript元件，變成只要套用就能快速的寫出前端的框架，讓使用者能保持一致性的工具。此專題中利用了一些Bootstrap所提供的套件，讓網頁可以在不同螢幕尺寸上轉換時自動更改排版以維持內容閱讀的方便性。

3.2.2 CanvaJS  
	CanvasJS為線上的一個免費資源，透過HTML和JavaScript來將資料圖形化呈現。CanvasJS的優點為使用容易且提供了許多不同的圖形樣式給使用者選擇。此專題中利用CanvasJS來將一些數值資料以圖形方式呈現給使用者，讓使用者可以更輕易的理解資料。

3.2.3 JSON Simple  
	JSON Simple為Google推出的JSON格式檔案編譯套件。“我還想要”平臺提供民眾可下載平臺上整理後資料的JSON檔案，內部包含了所以民眾所提出的建議內容、原因、分派機關等等的資訊。我們透過JSON Simple來處理“我還想要”平臺所提供的資料。

3.2.4 MMSEG  
MMSEG為蔡志浩先生於2010年所開發的中文斷詞系統，MMSEG可以透過建立辭典的方式來將一段中文句子依詞語分開，像是將“對台灣現狀的分析與未來的思考”這句話解析為“對。台灣。現況。的。分析。與。未來的。思考”。其目的主要在於讓我們能夠將一段中文解析後找出關鍵字。

3.2.5 CKIP  
	CKIP為中研院所推出的斷詞系統，其功能與MMSEG相似，但CKIP的原理為透過將需要斷詞的資料傳送至中研院的線上系統，經過線上系統內，經由解析後將斷詞後的結果回傳給使用者。CKIP除了可以斷詞以外，還有詞類標記的功能，能夠將斷詞後的文字加上類別標記後回傳給使用者，像是將對台灣現狀的分析與未來的思考”解析為“對(P)　台灣(Nc)　現狀(Na)　的(DE)　分析(Na)　與(Caa)　未來(Nd)　的(DE)　思考(VE)”，每個詞後面括弧內的英文即為該詞的詞類，而中研院有提供詞類簡寫對應表讓使用者查詢。

3.2.6 Weka  
Weka全名為Waikato Environment for Knowledge Analysis，為懷卡託大學出身的開法者所研發的資料探勘與機器學習軟體，主要以Java為基礎的開放原始碼軟件，其包含了資料探勘演算法。此專題中利用Weka內所提供的預測工具來找出關鍵字與分派機關之間的關聯。

3.2.6 OAuth  
	OAuth開放授權為一種開放標準，允許使用者讓第三方應用存取該使用者在某一網站上儲存的私密的資源（如姓名、信箱等等），而不必將使用者名稱和密碼提供給第三方應用。其原理為第三方應用會有另一網站給予他的一組識別碼，當使用者要登入時，使用者會同意網站給予特定第三方應用存取特定的資料，此時網站會給予第三方應用專屬的取得密碼，透過密碼第三方應用可以向網站取得先前使用者同意給予的資訊。透過開放授權可以讓使用者不必創建新的帳號和記憶新的密碼，開發者也可以不必為了儲存使用者的資訊而特別建立會員資料庫。

4. 系統設計  
4.1 第一部分   
4.1.1 抓取“我還想要”平臺之資料  
為了能夠分析“我還想要”平臺上的資料，我們必須先取得所有需要的資訊，包含“建議資料標題”、“建議資料集名稱”、“建議開放欄位”、“建議原因”、“選擇呈送機關”、“回覆狀態”和“回覆日期”。政府開放資料平臺最初有提供部分資料給民眾下載，且在經過我們建議要求提供更完整的資料後，政府開放資料平臺隨即更新資料並補上了先前為提供的項目。因此我們便利用政府開放資料平臺所提供的下載資料來取得我們需要的資料項目。政府開放資料平臺有提供三種不同的資料格式，分別為CSV、JSON、XML，而我們選擇使用JSON。

4.1.2 資料統計與分析  
首先我們使用PHP來抓取JSON檔案並使用PHP來讀取。接著決定出我們要呈現出哪些資料給使用者，我們將目標分為兩個區塊，一個是關於“我還想要”平臺的統計分析，包含總資料筆數、尚未回應的資料數量、平均回應的時間、最久未回應的資料和正式回應的時間數量。由於“我還想要”平臺在收到建議後會先由平臺營運團隊的人回覆告知收到建議，並指名此建議將由哪個機關負責處理，日後再由負責處理的機關正式回應，如圖三所示。因此我們將平臺營運團隊回覆的資料稱為平臺回應，由負責機關回應的回覆稱為正式回應。第二個區塊則是以比較為主，統計在所有建議中哪些部門所收到的建議最多和各個部門在收到建議後回應所花費的資料。由以上資料來了解人民的需求傾向為何，和監督各個機關的執行效率。

4.1.3 將統計後的資料存入資料庫  
在經過統計後我們將結果存入由MySQL所建立的資料庫中，讓未來使用者開啟網頁時不必耗時統計，只需要經由PHP將存在資料庫內的資料呈現出來即可。

4.1.4 透過文字和圖形將統計資料呈現  
將所需要的資料都準備好後，我們則利用Bootstrap配合CanvasJS將資料以為自配合圖表的方式呈現給使用者，如圖四至六所示。

4.2 第二部分  
4.2.1 抓取“我還想要”平臺之資料  
	和第一部分相同，利用政府開放資料平臺所提供的資料，同樣的我們選擇了JSON格式。

4.2.2 剔除不需要之資訊  
	在尋找建議內容和對應機關的關係時我們只需要用到有包含文字的內容和對應機關這兩種資料，因此我們將其他不必要的資訊都先剔除，只留下建議資料標題”、“建議資料集名稱”、“建議開放欄位”、“建議原因”和“分派機關”。

4.2.3 利用斷詞系統將，將資料中的文字斷詞，並找出關鍵字  
	由於中文與英文在句子上的結構不同，每一個英文單字都是一個詞，具有各自的意義，但中文除了字以外還有詞，字可以單獨出現代表意義，也可以透過與其他字組合代表相同或不同的意義，如：“火”單獨出現代表的是英文的Fire，但如果加上了一個字變成“怒火”，其意思即改變為英文的anger。由這個例子可以知道斷詞在關鍵字的抓取過程中是十分重要的，因此我們取用了兩個不同的斷詞系統來做比較和測試。
	第一個斷詞系統為MMSEG，MMSEG主要為利用建立詞庫的方式，比對資料和字庫，它提供了兩種比對法則，簡單匹配法與複雜匹配法。為了取得更高的正確率我們選擇了複雜匹配法，並利用MMSEG來將斷詞作業由Java來完成。除了MMSEG以外我們還測試了中研院所研發的CKIP斷詞系統。CKIP與MMSEG的自建詞庫不同，CKIP為將所需要斷詞的資料送至中研院的斷詞服務，透過中研院所建立的龐大詞庫來分析需要斷詞的資料。除此之外中研院也研發出了獨特的未知詞(未在詞庫內的詞)判斷規則。我們利用了Open Source的資源CKIP Client將CKIP整合入Java程式內，讓斷詞過程變得更簡單。
	測試過MMSEG與CKIP兩套斷詞系統以後，我們拿了一些資料來做為比較基準，比較透過兩套斷詞系統所實行出來的結果如何。

測試一
	測試文：能否開放全國各車型驗車資料，里程數紀錄，驗車日期，檢驗異常項目
	MMSEG斷詞結果：
能否|開放|全國|車型|驗|車資|料|里程|數|紀錄|驗|車|日期|檢驗|異常|項目|
	CKIP斷詞結果：
能否|開放|全國|各|車型|驗|車|資料|里程|數|紀錄|驗|車|日期|檢驗|異常|項目
	
測試二
	測試文：全國性有合格藥師、藥劑生登錄之健保藥局名錄
	MMSEG斷詞結果：
全國性|合格|藥師|藥劑|生|登錄|健|保|藥|局|名錄
	CKIP斷詞結果:
	全國性|有|合格|藥師|藥劑|生|登錄|之|健保|藥局|名錄

	透過這兩個測試的結果，我們可以發現CKIP在一些專有名詞上的處理較MMSEG好，如“驗車資料”即被MMSEG斷詞為|驗|車資|料|，將原本應該是|驗車|資料|的關鍵字斷詞為並不應該出現的|車資|。因此透過多次的比較和比對，我們決定選擇CKIP作為我們找出關鍵字所使用的斷詞系統。
	在完成斷詞以後，我們必須找出建議資料中的關鍵字，首先我們嘗試的方法為利用停止詞。停止詞的意思為建立一個包含一些中文語句中無重要意義，主要為了讓溝通和語句變的更通順而存在在詞語，如：“而且”、“但是”、“怎麼”和標點符號語助詞等等。透過比對斷詞後的資料可以將資料中的對資料分析沒有幫助的詞語剔除，並以剔除後的資料來做接下來的分析。
	除了使用停止詞以外我們還嘗試了透過CKIP斷詞後所提供的詞性來判斷是否為關鍵詞。以上面的測試文為例，我們可以要求中研院伺服器在回傳資料時要求同時回傳斷詞後單詞的詞性，如上面的例子“能否開放全國各車型驗車資料，里程數紀錄，驗車日期，檢驗異常項目”，經由CKIP斷詞並加上詞性後的結果會變成“能否(D)　開放(VC)　全國(Nc)　各(Nes)　車型(Na)　驗(VC)　車(Na)　資料(Na) 里程(Na)　數(VC)　紀錄(Na)　驗(VC)　車(Na)　日期(Na)　檢驗(VC)　異常(VH)　項目(Na)”。中研院也提供了詞性對應表，如(D)代表副詞、(VC)代表動作及物動詞、(Nes)代表特指定詞等等。而透過檢視與比對加上詞性後的斷詞結果後，我們發現在所有詞性中，我們所想要抓取的關鍵詞主要為資料中的名詞，因為資料中的名詞多與該資料的對應機關有比較大的關係，而動詞的相對於名詞而言與對應機關的關係比較小，其他的詞性如副詞、語助詞、連接詞等等的則偏向類似停止詞，也非我們所需要的資料，因此我們選擇挑出名詞來當作關鍵字。
	在測試過停止詞和CKIP的詞性分類法以後，我們比對了兩者的過濾結果。以相同語句為例：
	測試文：能否|開放|全國|各|車型|驗|車|資料|里程|數|紀錄|驗|車|日期|檢驗|異常|項目
	停止詞的過濾結果：|開放|全國|車型|驗|車|資料|里程|紀錄|驗|車|日期|檢驗|異常|項目
	CKIP詞性的過濾結果：全國(Nc) 車型(Na) 車(Na)　資料(Na) 里程(Na) 紀錄(Na)　車(Na)　日期(Na) 項目(Na)
	比較結果我們發現兩者差異不大，但CKIP詞性的過濾結果相較而言較精簡。經過比對過更多資料以後，我們決定選擇使用CKIP的詞性過濾方法，盡可能將關鍵字的數量精簡化避免不必要的詞句影響到之後的分析比對。

4.2.4 透過每筆資料的關鍵字和分配機關比對  
	取出關鍵詞後，我們將利用Weka來運算分析資料，因此需先將先前的結果儲存為Weka可讀性的資料格式。我們利用Weka所提供的jar套件，將先前的結果儲存為arff檔，結果如圖七所示。

4.2.5 找出每個關鍵字和分配機關的對應關係  
	為了找出關鍵字和分配機關之間的關係，我們使用了一些常見普遍的分類器。為了找出最適合的方法，我們嘗試了幾種不同的分類器，並透過不同的訓練和測試比率，尋找較高的正確率。
	我們選擇了三種常見的，分別是簡單貝式分類(Naive Bayes)、隨機森林(Random Forest)和簡單邏輯分析(Simple Logistic)。並分別嘗試在將現有資料分成70%、80%和90%的訓練資料，將剩餘的資料作為測試資料，推算出分析模型。測試結果如表一所示。

表一 測試結果  
	70%	80%	90%
簡單邏輯	30.63%	32.43%	35.13%
隨機森林	17.11%	12.16%	21.62%
簡單貝式	24.32%	28.37%	45.94%


4.2.6 利用找出的關聯，進而推論新的資料應該對應的分配機關  
	最後，我們使用先前訓練出來的分析模型，將未知的資料輸入並預測對應的機關。我們製作了一個簡易的政府開放平臺“我還想要”專區的網路模擬介面，如圖八所示，讓使用者可以體驗透過輸入資料來測試並預測該資料對應的機關。

4.2.6 登入防護機制  
	但為了避免同時有大量非善意的使用者使用影響到網站的效能，因此我們建立的一道登入機制作為防護，要求使用者必須登入才可以使用分析測試系統，如圖九所示。登入的方式我們選擇利用開放授權標準OAuth，讓使用者可以利用現有的帳號密碼來登入驗證身分，而不必為了此網頁再建立一個帳號。而我們選擇的認證平台為最多人使用的Facebook和Google。透過OAuth開放授權標準，我們能夠讓已經有Facebook和Google帳戶的人能登入，並且在不會取得使用者的帳號密碼的前提下能取得我們所需要的使用者資訊。讓使用者可以放心地使用我們的平台。

5. 未來展望  
	目前的程式還不夠完善與完備，希望未來能透過程式的調整提升資料處理的效率和預測的正確率。希望未來隨著“我還想要”平臺上的資料增加，能將資料庫變的更完善來提高準確度。並且將程式提供給政府開放資料平臺，讓這個程式可以真正的為“我還想要”平臺分析預測分派機關，提高政府開放資料平臺效率並節省人力成本。除此之外，我們也規劃在日後將程式原始碼開放於網路上，讓有興趣的人們可以自由地的參考和使用。

6. 參考文獻  
[1]	 Chen, K.J. & S.H. Liu, "Word Identification for Mandarin Chinese Sentences," Proceedings of COLING 1992, pages 101-107<br/>
[2]	 Chen, K.J. & Ming-Hong Bai, "Unknown Word Detection for Chinese by a Corpus-based Learning Method," International Journal of Computational linguistics and Chinese Language Processing, 1998, Vol.3, #1, pages 27-44<br/>
[3]	Chen, K.J. & Wei-Yun Ma, "Unknown Word Extraction for Chinese Documents," Proceedings of COLING 2002, pages 169-175 <br/>
[4]	 Che-Ying Wu, “CKIP Client”, http://ckipclient.sourceforge.net/<br/>
[5]	Daniel Dietrich, Tim McNamara, Tim McNamara, Antti Poikola, Rufus Pollock, Julian Tait and Ton Zijlstra, Open Data Handbook http://opendata handbook. org/guide/zh_TW/what-is-open-data/<br/>
[6]	Eibe Frank, Mark Hall, Peter Reutemann, and Len Trigg, Weka, http://www.cs.waikato.ac.nz/ml/index.html<br/>
[7]	Jose Maria Gomez Hidalgo, 2013.01.29, Text Mining in WEKA: Chaining Filters and Classifiers,<br/>
[8]	Ma Wei-Yun & K.J. Chen, "A bottom-up Merging Algorithm for Chinese Unknown Word Extraction," Proceedings of ACL workshop on Chinese Language Processing 2003, pages 31-38<br/>
[9]	Mark Otto, Jacob Thornton, Bootstrap, http://getbootstrap.com/<br/>
[10]	National Digital Archives Program, Taiwan, CKIP System, http://ckipsvr.iis.sinica.edu.tw/<br/>
[11]	Yu-Cheng Chuang, OAuth 2.0, https://blog.yorkxin.org/posts/2013/09/30/oauth2-1-introduction/<br/>
