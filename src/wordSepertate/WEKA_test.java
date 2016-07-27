package wordSepertate;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.text.ParseException;
import java.util.ArrayList;

import org.json.simple.JSONObject;

import weka.core.Attribute;
import weka.core.DenseInstance;
import weka.core.FastVector;
import weka.core.Instance;
import weka.core.Instances;

public class WEKA_test {
	static JSONObject jsonObject2 =  new JSONObject();
	static ArrayList<String> orgArray = new ArrayList<String>();
	
	private static void database() throws IOException{
		FileReader reader1 = null;
		try {
			reader1 = new FileReader("C:/xampp/phpMyAdmin/Project/data/CuttedData_test.txt"); 
		}catch(IOException e){
			System.out.println("test讀取開啟錯誤");
		}// try-catch
		BufferedReader dataReader1 = new BufferedReader(reader1); //逐行讀取 CuttedData.txt
		String str = "";
		boolean same1 = false;
		while((str=dataReader1.readLine()) != null)
		{
			String[] spilted = str.split("。");
			for(int i=0; i<orgArray.size();i++){//是否為未出現過的org
				if(orgArray.contains(spilted[0])){
					same1 = true;
					break;
				}else{
					same1 = false;
				}//else
			}//for
			if(same1 == false){
				orgArray.add(spilted[0]);
			}//if
		}//while
		dataReader1.close();
		reader1.close();
		///////////建立arff資料檔////////
	}
	
	private static void createArff() throws IOException {
		FileReader reader = null;
		try {
			reader = new FileReader("C:/xampp/phpMyAdmin/Project/data/CuttedData_test.txt"); 
		}catch(IOException e){
			System.out.println("test讀取開啟錯誤");
		}// try-catch
	    BufferedReader dataReader = new BufferedReader(reader); //逐行讀取 CuttedData.txt
	    String str="";	    // add attribute
		FastVector attributes = new FastVector();
		attributes.addElement(new Attribute("keyword", (FastVector) null));
		FastVector attVals = new FastVector();
		attVals.addElement("dummy");
		for (int i = 0; i < orgArray.size(); i++){ //add org attribute
			attVals.addElement(orgArray.get(i));
		}
		attributes.addElement(new Attribute("organization", attVals));
	   
	    // add data
	    Instances data = new Instances("opendata",attributes,0);
	    while((str=dataReader.readLine()) != null){
	    	Instance keyword = new DenseInstance(2);
			String[] spilted2 =str.split("。");
			if(spilted2[0].equals("none")){
			}
			else{
				keyword.setValue((Attribute)attributes.elementAt(0),spilted2[1]);
				keyword.setValue((Attribute)attributes.elementAt(1),spilted2[0]);
				data.add(keyword);
			}
		}
//	    System.out.println(data);
	    FileWriter writer = new FileWriter("C:/xampp/phpMyAdmin/Project/data/opendata_test.arff");
	    PrintWriter printfile = new PrintWriter(writer);
	    printfile.print(data);
	    printfile.close();

	}
	
	public static void main(String[] args) throws IOException, ParseException, org.json.simple.parser.ParseException, Error {
		CKIP_test ckip = new CKIP_test();
		ckip.main(args);
		database();
		createArff();
		
	}

}
