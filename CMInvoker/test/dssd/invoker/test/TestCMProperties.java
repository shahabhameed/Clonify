package dssd.invoker.test;

import dssd.invoker.CMProperties;
import junit.framework.TestCase;

public class TestCMProperties extends TestCase {

	public TestCMProperties(String name) {
		super(name);
	}

	protected void setUp() throws Exception {
		super.setUp();
	}
	
	public void testLoadProperties(){
		CMProperties.loadProperties();
		assertTrue(CMProperties.isAllSet());
	}

	protected void tearDown() throws Exception {
		super.tearDown();
	}

}
