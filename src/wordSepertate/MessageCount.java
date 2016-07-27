package wordSepertate;

public class MessageCount {
	private String Volcabulary;
	private int Count;
	public MessageCount(){
		setVolcabulary("");
		setCount(0);
	}
	
	public MessageCount(String n, int s){
		setVolcabulary(n);
		setCount(s);
	}
	
	public void setCount(int i) {
		Count = i;
	}
	
	public void setVolcabulary(String n) {
		Volcabulary = n ;
	}
	
	public String getVolcabulary(){
		return Volcabulary;
	}
	
	public int getCount(){
		return Count;
	}

	public void newVol(String string, int i) {
		setVolcabulary(string);
		setCount(i);
		
	}
	
}
