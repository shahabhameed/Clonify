package dssd.invoker.test;

import junit.framework.TestCase;
import dssd.invoker.MyExternalThread;

public class TestMyExternalThread extends TestCase {

	public TestMyExternalThread(String name) {
		super(name);
	}

	protected void setUp() throws Exception {
		super.setUp();
	}
	
	public void testInit(){
		MyExternalThread myExternalThread = new MyExternalThread(null); 
		assertFalse(myExternalThread.isAllSet());
	}
	
	public void testHasRunCompletedSuccessfully(){
		MyExternalThread myExternalThread = new MyExternalThread(null); 
		myExternalThread.run();
		assertTrue(myExternalThread.isRunExitedSuccessfully());
	}

	protected void tearDown() throws Exception {
		super.tearDown();
	}

}
