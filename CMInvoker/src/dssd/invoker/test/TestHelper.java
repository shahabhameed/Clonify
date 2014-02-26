package dssd.invoker.test;

import junit.framework.TestCase;
import dssd.invoker.TextInputFilesGenerator;
import dssd.invoker.InvokeParameter;

public class TestHelper extends TestCase {

	TextInputFilesGenerator helper;
	
	public TestHelper(String name) {
		super(name);
	}

	protected void setUp() throws Exception {
		super.setUp();
		helper = new TextInputFilesGenerator();
	}

	public void testMakeInputFile1(){
		helper.setData(null);
		assertFalse(helper.makeCMInputFile());
	}
	
	public void testMakeInputFile2(){
		InvokeParameter invokeParameter = new InvokeParameter();
		helper.setData(invokeParameter);
		assertFalse(helper.makeCMInputFile());
	}
	
	protected void tearDown() throws Exception {
		super.tearDown();
	}

}
