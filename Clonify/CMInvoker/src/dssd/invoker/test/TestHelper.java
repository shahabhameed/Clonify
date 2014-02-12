package dssd.invoker.test;

import junit.framework.TestCase;
import dssd.invoker.Helper;
import dssd.invoker.InvokeParameter;

public class TestHelper extends TestCase {

	public TestHelper(String name) {
		super(name);
	}

	protected void setUp() throws Exception {
		super.setUp();
	}

	public void testMakeInputFile1(){
		assertTrue(Helper.makeInputFile(null));
	}
	
	public void testMakeInputFile2(){
		InvokeParameter invokeParameter = new InvokeParameter();
		assertTrue(Helper.makeInputFile(invokeParameter));
	}
	
	public void testMakeEqualTokensFile1(){
		Helper.makeEqualTokensFile(null);
	}
	
	public void testMakeEqualTokensFile2(){
		InvokeParameter invokeParameter = new InvokeParameter();
		Helper.makeEqualTokensFile(invokeParameter);
	}
	
	public void testMakeSuppressedTokenFile1(){
		Helper.makeSuppressedTokenFile(null);
	}
	
	public void testMakeSuppressedTokenFile2(){
		InvokeParameter invokeParameter = new InvokeParameter();
		Helper.makeSuppressedTokenFile(invokeParameter);
	}
	
	public void testMakeClusterParametersFile1(){
		Helper.makeClusterParametersFile(null);
	}
	
	public void testMakeClusterParametersFile2(){
		InvokeParameter invokeParameter = new InvokeParameter();
		Helper.makeClusterParametersFile(invokeParameter);
	}
	
	protected void tearDown() throws Exception {
		super.tearDown();
	}

}
