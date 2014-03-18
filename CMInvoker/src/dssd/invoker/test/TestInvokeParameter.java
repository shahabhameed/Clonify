package dssd.invoker.test;

import java.util.ArrayList;
import java.util.List;

import junit.framework.TestCase;
import dssd.invoker.InvocationFileInfo;
import dssd.invoker.InvokeParameter;

public class TestInvokeParameter extends TestCase {

	public TestInvokeParameter(String name) {
		super(name);
	}
	
	@Override
	protected void setUp() throws Exception {
		super.setUp();
	}
	
	public void testInit1(){
		InvokeParameter invokeParameter = new InvokeParameter();
		assertFalse(invokeParameter.isAllSet());
	}

	public void testInit2(){
		Integer invocation_id = 0;
		Integer min_similatiry_SCC_tokens = 0;
		Integer grouping_choice = 0;
		Integer method_analysis = 0;
		String suppressed_tokens = "";
		String equal_tokens = "";
		List<List<InvocationFileInfo>> input_files = new ArrayList<List<InvocationFileInfo>>();
		
		InvokeParameter invokeParameter = new InvokeParameter(invocation_id, min_similatiry_SCC_tokens, grouping_choice, method_analysis, suppressed_tokens, equal_tokens, input_files);		
		assertFalse(invokeParameter.isAllSet());
	}

	public void testInit3(){
		Integer invocation_id = -1;
		Integer min_similatiry_SCC_tokens = 0;
		Integer grouping_choice = 0;
		Integer method_analysis = 0;
		String suppressed_tokens = "";
		String equal_tokens = "";
		List<List<InvocationFileInfo>> input_files = new ArrayList<List<InvocationFileInfo>>();
		
		InvokeParameter invokeParameter = new InvokeParameter(invocation_id, min_similatiry_SCC_tokens, grouping_choice, method_analysis, suppressed_tokens, equal_tokens, input_files);		
		assertFalse(invokeParameter.isAllSet());
	}

	public void testInit4(){
		Integer invocation_id = -1;
		Integer min_similatiry_SCC_tokens = 0;
		Integer grouping_choice = 0;
		Integer method_analysis = 0;
		String suppressed_tokens = "a";
		String equal_tokens = "a";
		List<List<InvocationFileInfo>> input_files = new ArrayList<List<InvocationFileInfo>>();
		ArrayList<InvocationFileInfo> someList = new ArrayList<InvocationFileInfo>();
		someList.add(new InvocationFileInfo("A",1));
		input_files.add(someList); 
		
		InvokeParameter invokeParameter = new InvokeParameter(invocation_id, min_similatiry_SCC_tokens, grouping_choice, method_analysis, suppressed_tokens, equal_tokens, input_files);		
		assertFalse(invokeParameter.isAllSet());
	}

	public void testInit5(){
		Integer invocation_id = 0;
		Integer min_similatiry_SCC_tokens = 0;
		Integer grouping_choice = 0;
		Integer method_analysis = 0;
		String suppressed_tokens = "a";
		String equal_tokens = "a";
		List<List<InvocationFileInfo>> input_files = new ArrayList<List<InvocationFileInfo>>();
		ArrayList<InvocationFileInfo> someList = new ArrayList<InvocationFileInfo>();
		someList.add(new InvocationFileInfo("a",2));
		
		InvokeParameter invokeParameter = new InvokeParameter(invocation_id, min_similatiry_SCC_tokens, grouping_choice, method_analysis, suppressed_tokens, equal_tokens, input_files);		
		assertFalse(invokeParameter.isAllSet());
	}

	
	@Override
	protected void tearDown() throws Exception {
		super.tearDown();
	}

}
