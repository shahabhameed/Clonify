package dssd.invoker.test;

import java.lang.reflect.Array;
import java.util.ArrayList;

import junit.framework.TestCase;
import dssd.invoker.InvokeParameter;

public class TestInvokeParameter extends TestCase {

	/**
	 * @param name
	 */
	public TestInvokeParameter(String name) {
		super(name);
	}
	
	@Override
	protected void setUp() throws Exception {
		// TODO Auto-generated method stub
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
		ArrayList<String> input_files = new ArrayList<String>();
		
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
		ArrayList<String> input_files = new ArrayList<String>();
		
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
		ArrayList<String> input_files = new ArrayList<String>();
		input_files.add("a"); 
		
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
		ArrayList<String> input_files = new ArrayList<String>();
		input_files.add("a"); 
		
		InvokeParameter invokeParameter = new InvokeParameter(invocation_id, min_similatiry_SCC_tokens, grouping_choice, method_analysis, suppressed_tokens, equal_tokens, input_files);		
		assertTrue(invokeParameter.isAllSet());
	}

	
	@Override
	protected void tearDown() throws Exception {
		// TODO Auto-generated method stub
		super.tearDown();
	}

}
