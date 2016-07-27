package wordSepertate;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.text.ParseException;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;

import tw.cheyingwu.ckip.CKIP;
import tw.cheyingwu.ckip.Term;

public class CKIP_test {
	public static String sentance;
	private static CKIP segword = new CKIP("140.109.19.104",1501,"4102029006", "22680706");
	
	private static String cleaner(String sentance){
		String text = "";
		text=sentance;
		text=text.replaceAll("[\\s*|\t|\r|\n]", "");
		text=text.replaceAll("&amp;", "");
		text=text.replaceAll("&lt;", "");
		text=text.replaceAll("&gt;", "");
		text=text.replaceAll("&apos;", "");
		text=text.replaceAll("&quot;", "");
		text=text.replaceAll("&#039;", "");
		return text;
	}
	
	public static void main(String[] argv)throws IOException, ParseException,java.lang.Error, org.json.simple.parser.ParseException{
		FileReader reader = null;
		File newdata = new File("C:/xampp/phpMyAdmin/Project/data/CuttedData_test.txt"); 
		newdata.delete();
		newdata.createNewFile(); // �M��CuttedData.txt
		JSONParser parser = new JSONParser();
		try {
			reader = new FileReader("C:/xampp/phpMyAdmin/Project/data/opendata.json"); 
		}catch(IOException e){
			System.out.println("opendata.json�}�ҿ��~");
		}// try-catch
		JSONArray jsonArray = (JSONArray) parser.parse(reader); // Parse JSON
		reader.close();	
		FileWriter writefile = null;//////////////
		try{
          writefile = new FileWriter("C:/xampp/phpMyAdmin/Project/data/CuttedData_test.txt",true);
		}catch (IOException e){
          System.out.print( "CuttedData �L�k�}��");
		}
		PrintWriter printfile = new PrintWriter(writefile);//////////////
		String determine1 = "N";
		String determine2 ="Nv";
		String determine3 ="Na";
		String org = "";
		for(int i= 0; i<jsonArray.size();i++) //�NJSON�e��MMSEG
		{
			sentance = "";
			JSONObject jsonObject = (JSONObject)jsonArray.get(i);
			String Title = (String) jsonObject.get("suggestTitle");
			String Field = (String) jsonObject.get("suggestFieldDesc");
			String Dataset = (String) jsonObject.get("suggestDatasetTitle");
			String Reason = (String) jsonObject.get("suggestReason");
			sentance = Title+ "，" + Field +  "，" + Dataset +  "，" + Reason + "，";
			sentance=cleaner(sentance);
			segword.setRawText(sentance);
			segword.send();
			if(jsonObject.get("deliverOrg").equals("")){
				printfile.print("none。");
			}else{
				org=(String) jsonObject.get("deliverOrg");
				org=org.replaceAll(",","、");
				printfile.print(org+"。");
			}//else
			for(Term t : segword.getTerm()){
//				System.out.println(t.getTerm());
				if(t.getTerm() == null){
					
				}//if
				else if(t.getTag().equals(determine1))
				{
					printfile.print(" "); 
					printfile.print(t.getTerm());
				}
				else if(t.getTag().equals( determine2)){
					printfile.print(" ");
					printfile.print(t.getTerm());
				}//else if
				else if(t.getTag().equals( determine3)){
					printfile.print(" ");
					printfile.print(t.getTerm());
				}
			}
			printfile.println("");
			if(i%10 ==10){  //�C10���Ȱ������
				try {
				    Thread.sleep(2000); 
				} catch(InterruptedException ex) {
				 
				}//try-catch
			}//for
		}//for
		printfile.close();
		writefile.close();
		///////////////// CKIP done
	}
}