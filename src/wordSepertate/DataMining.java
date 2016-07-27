package wordSepertate;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.ObjectOutputStream;
import java.io.OutputStreamWriter;
import java.io.PrintWriter;
import java.io.Writer;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.util.ArrayList;
import java.util.LinkedHashMap;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import weka.classifiers.Classifier;
import weka.classifiers.Evaluation;
import weka.classifiers.bayes.NaiveBayes;
import weka.classifiers.functions.SimpleLogistic;
import weka.classifiers.trees.LMT;
import weka.classifiers.trees.RandomForest;
import weka.classifiers.trees.J48;
import weka.core.Attribute;
import weka.core.DenseInstance;
import weka.core.FastVector;
import weka.core.Instance;
import weka.core.Instances;
import weka.core.converters.ArffLoader;
import weka.core.converters.ArffSaver;
import weka.core.converters.ConverterUtils.DataSource;
import weka.filters.unsupervised.attribute.NumericToBinary;
import weka.filters.Filter;
import weka.filters.unsupervised.instance.NonSparseToSparse;

@SuppressWarnings("unused")
public class DataMining {
	static JSONObject jsonObject2 =  new JSONObject();
	static ArrayList<String> orgArray = new ArrayList<String>();
	static ArrayList<String> kwArray = new ArrayList<String>();
	private static MessageCount[] count(String[] array){
		MessageCount[] Array1 =  new MessageCount[array.length] ;
		boolean determin = true;
		MessageCount Array2 = new MessageCount("", 0);
		Array1[0] = Array2;
		int max = 1;
		for(int i=1; i< array.length ; i++)
		{
			int j=0;
			int count = 0;
			do
			{
				String Vol = Array1[j].getVolcabulary();
				if(Vol.equals(array[i]))
				{
					count = 0;
					count = Array1[j].getCount();
					count++;
					Array1[j].setCount(count);
					determin = false;
					break;
				}//if
				else
				{
					determin = true;
				}//else
				j++;
			}while(j < max);
			if( determin == true )
			{
				MessageCount Array3 = new MessageCount(array[i],1);
				Array1[j] = Array3;
				max++;
			}//if
			else
			{
				// Do Nothing
			}//else
		}//for
		Array1 = sort(Array1,max);
		return Array1;
	}
	
	protected static MessageCount[] sort(MessageCount[] array, int max){  //排序
		MessageCount[] sortArray = array;
		int length = max;
		String permantVol1;
		String permantVol2;
		int permantCount1;
		int permantCount2;
		for(int i=0; i< length; i++)
		{
			
			for(int j=i+1; j< length; j++)
			{
				permantCount1 =sortArray[i].getCount();
				permantCount2 =sortArray[j].getCount();
				if(permantCount1 < permantCount2)
				{
					permantVol1 =sortArray[i].getVolcabulary();
					permantVol2 =sortArray[j].getVolcabulary();
					MessageCount Array1 = new MessageCount(permantVol1, permantCount1);
					MessageCount Array2 = new MessageCount(permantVol2, permantCount2);
					sortArray[i] = Array2;
					sortArray[j] = Array1;
				}
			}
		}
		return sortArray;
	}
	
	private static void database() throws IOException{
		FileReader reader1 = null;
		try {
			reader1 = new FileReader("C:/xampp/phpMyAdmin/Project/data/CuttedData.txt"); 
		}catch(IOException e){
			System.out.println("Cutted.json讀取開啟錯誤");
		}// try-catch
		BufferedReader dataReader1 = new BufferedReader(reader1); //逐行讀取 CuttedData.txt
		String str = "";
		boolean same1 = false;
		boolean same2 = false;
		String word = "";
		while((str=dataReader1.readLine()) != null)
		{
			MessageCount[] counted = new MessageCount[0];
			String[] spilted = str.split(",");
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
			counted=count(spilted);
//			if(spilted[1].equals("資料") && spilted[0].equals("內政部"))	{
//				///去除有問題資料
//			}
//			else{// 建立  關鍵字 資料庫
				for(int j=0;j<counted.length;j++){
					if(j>10){
						break;
					}else{
						if(counted[j] == null)
							break;
						word = counted[j].getVolcabulary();
						same2 = false;
						for(int k=0;k<kwArray.size();k++){
							if(kwArray.contains(word)){
								same2 = true;
								break;
							}else{
								same2 = false;
							}//else
						}//for
						if(same2 == false){
							kwArray.add(word);
						}//if
//					}//else
				}//for
			}//else
		}//while
		dataReader1.close();
		reader1.close();
	}
	
	private static void createArff() throws IOException {///////////建立arff資料檔////////
		FileReader reader = null;
	    try {
			reader = new FileReader("C:/xampp/phpMyAdmin/Project/data/CuttedData.txt"); 
		}catch(IOException e){
			System.out.println("CuttedData.txt開啟錯誤");
		}// try-catch
	    BufferedReader dataReader = new BufferedReader(reader); //逐行讀取 CuttedData.txt
	    int r = 0;
	    int permant2;
	    boolean same3 = false;
	    String str="";
	    String permant;
	    String no;
	    // add attribute
		FastVector attributes = new FastVector();
		FastVector attVals = new FastVector();
		
	    for(int i=0;i<kwArray.size();i++){  //add keyword attribute
			attributes.addElement(new Attribute("data"+i));
		}
	    attVals.addElement("dummy");
	    for (int i = 0; i < orgArray.size(); i++){ //add org attribute
			attVals.addElement(orgArray.get(i));
		}
		attributes.addElement(new Attribute("organization", attVals));
	    // add data
	    Instances data = new Instances("opendata",attributes,0);
	    while((str=dataReader.readLine()) != null){
	    	Instance keyword = new DenseInstance(kwArray.size()+1);
	    	MessageCount[] counted = new MessageCount[0];
			MessageCount[] Vol = new MessageCount[0];
			String[] spilted2 =str.split(",");
			Vol = count(spilted2);
			if(spilted2[0].equals("none")){
			}
			else{
				int i=0;
				for(i = 0;i<kwArray.size();i++){
					permant2 =0;
					for(int j =0;j<10;j++){
						if(Vol[j] == null){
							break;
						}else if((Vol[j].getVolcabulary()).equals(kwArray.get(i))){
							same3 = true;
							permant=Vol[j].getVolcabulary();
							permant2 = Vol[j].getCount();
							break;
						}else{
							same3 = false;
						}
					}
					keyword.setValue((Attribute)attributes.elementAt(i),permant2);
				}
				keyword.setValue((Attribute)attributes.elementAt(i),spilted2[0]);
				data.add(keyword);
			}
		}
	    FileWriter writer = new FileWriter("C:/xampp/phpMyAdmin/Project/data/opendata.arff");
	    PrintWriter printfile = new PrintWriter(writer);
	    printfile.print(data);
	    printfile.close();
	}
	
	private static void WEKA_run() throws Exception {
		
		ArffLoader loader = new ArffLoader();
	    loader.setFile(new File("C:/xampp/phpMyAdmin/Project/data/opendata.arff"));
	    Instances data = loader.getStructure();
		String[] options = new String[3];
		data.setClassIndex(data.numAttributes() - 1); 
		Classifier[] models = { 
				new NaiveBayes(), 
				new RandomForest(), 
				new SimpleLogistic(),
		};
 		models[0].buildClassifier(data);
 		weka.core.SerializationHelper.write("C:/xampp/phpMyAdmin/Project/data/NaiveBayes.model", models[0]);
 		weka.core.SerializationHelper.write("C:/xampp/phpMyAdmin/Project/data/RandomForest.model", models[1]);
 		weka.core.SerializationHelper.write("C:/xampp/phpMyAdmin/Project/data/SimpleLogistic.model", models[2]);
 		
//		Evaluation eTest = new Evaluation(data);
//		eTest.evaluateModel(NB, data);
//		String strSummary = eTest.toSummaryString();
//		System.out.println(strSummary);
//		 
		 // Get the confusion matrix
//		 double[][] cmMatrix = eTest.confusionMatrix();
	}
	
	public static void main(String[] argv) throws Exception{
//		CKIP_run ckip = new CKIP_run();
//		ckip.main(argv);
//		database();
//		createArff();
		WEKA_run();
	}//main
}//class
