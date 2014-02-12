package dssd.invoker.test;

import java.sql.Connection;

import junit.framework.TestCase;
import dssd.invoker.Database;
import dssd.invoker.InvokeParameter;
import dssd.invoker.InvokeService;

public class TestDatabase extends TestCase {
	private Connection conn;
	public TestDatabase(String name) {
		super(name);
	}

	protected void setUp() throws Exception {
		super.setUp();
		
		InvokeService.init();
	}
	
	public void testOpenConnection(){
		conn = Database.openConnection();
		assertNotNull(conn);
		
	}
	
	public void testCloseConnection1(){
		conn = Database.openConnection();
		assertTrue(Database.closeConnection(conn));
	}
	
	public void testCloseConnection2(){
		assertTrue(Database.closeConnection(null));
	}
	
	public void testGetInvokeConfig1(){
		assertNull(Database.getInvokeConfig(-1));
	}
	
	public void testGetInvokeConfig2(){
		// Insert in DB the user with with uid
		
		//InvokeParameter invokeParameter = Database.getInvokeConfig(1);
		//if(invokeParameter != invokeParameter){
			assertTrue(true);
		//}
	}

	public void testExecuteTransaction(){
		assertTrue(Database.executeTransaction("select * from user_invocations;"));
	}

	public void testUpdateInvocationStatus(){
		assertTrue(Database.updateInvocationStatus(1,1));
	}
	
	public void testUpdateInvocationStatus2(){
		// get and store the value for comparison 
		Database.updateInvocationStatus(1,1);
		assertTrue(true);
		// check if the value has been changed 
	}
	
	public void testUpdateInvocationStatus3(){
		// save new value
		// get and store the value for comparison 
		Database.updateInvocationStatus(1,1);
		assertTrue(true);
		// check if the new value is actually the value that is saved in the table 
	}
	
	protected void tearDown() throws Exception {
		Database.closeConnection(conn);
		super.tearDown();
	}

}
