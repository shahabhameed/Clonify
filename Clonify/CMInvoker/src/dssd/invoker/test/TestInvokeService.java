/**
 * 
 */
package dssd.invoker.test;

import junit.framework.TestCase;
import dssd.invoker.InvokeService;

/**
 * @author Hafeez
 *
 */
public class TestInvokeService extends TestCase {

	/**
	 * @param name
	 */
	public TestInvokeService(String name) {
		super(name);
	}

	/* (non-Javadoc)
	 * @see junit.framework.TestCase#setUp()
	 */
	protected void setUp() throws Exception {
		super.setUp();
	}
	
	public void testTestValue(){
		InvokeService invokeService = new InvokeService();
		int result = invokeService.getTestValue();
		assertEquals(result, 1);
	} 
	
	/* (non-Javadoc)
	 * @see junit.framework.TestCase#tearDown()
	 */
	protected void tearDown() throws Exception {
		super.tearDown();
	}

}
