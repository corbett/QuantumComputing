#!/usr/bin/env python
# Author: corbett@caltech.edu

import numpy as np
import unittest
import re
import random
from math import sqrt,pi,e
i_=np.complex(0,1)
####
## Gates
####
## One qubit gates
# Hadamard gate
H=1./sqrt(2)*np.matrix('1 1; 1 -1') 
# Pauli gates
X=np.matrix('0 1; 1 0')
Y=np.matrix([[0, -i_],[i_, 0]])
Z=np.matrix([[1,0],[0,-1]])

S=np.matrix([[1,0],[0,i_]])
Sdagger=np.matrix([[1,0],[0,-i_]]) # convenience Sdagger = S.conjugate().transpose()

T=np.matrix([[1,0],[0, e**(i_*pi/4.)]])
Tdagger=np.matrix([[1,0],[0, e**(-i_*pi/4.)]]) # convenience Tdagger= T.conjugate().transpose()

## Two qubit gates
# CNOT Gate
CNOT=np.matrix('1 0 0 0; 0 1 0 0; 0 0 0 1; 0 0 1 0')

####
## States
####
# standard basis (z)
zero_state=np.matrix('1; 0')
one_state=np.matrix('0; 1')
# diagonal basis (x)
plus_state=1/sqrt(2)*np.matrix('1; 1')
minus_state=1/sqrt(2)*np.matrix('1; -1')
# circular basis (y)
plusi_state=1/sqrt(2)*np.matrix([[1],[i_]])    # also known as clockwise arrow state
minusi_state=1/sqrt(2)*np.matrix([[1],[-i_]])  # also known as counterclockwise arrow state

# It seems to me to derive the ordering you do ((+) is outer product):
# Symbolically: |00> = |0> (+) |0>; gives 2x2 matrix which is then rewritten as 4x1 matrix by enumerate elements of rows from row 0
# In Python: (zero_state*zero_state.conjugate().transpose()).reshape(4,1)
two_qubits_00=np.matrix('1; 0; 0; 0')
two_qubits_01=np.matrix('0; 1; 0; 0')
two_qubits_10=np.matrix('0; 0; 1; 0')
two_qubits_11=np.matrix('0; 0; 0; 1')


def change_to_x_basis(state):
	return H*state

def change_to_y_basis(state):
	return H*Sdagger*state

def expectation_x(state):
	state_x=change_to_x_basis(state)
	prob_zero_state=(state_x.item(0)*state_x.item(0).conjugate()).real
	prob_one_state=(state_x.item(1)*state_x.item(1).conjugate()).real
	return prob_zero_state-prob_one_state	

def expectation_y(state):
	state_y=change_to_y_basis(state)
	prob_zero_state=(state_y.item(0)*state_y.item(0).conjugate()).real
	prob_one_state=(state_y.item(1)*state_y.item(1).conjugate()).real
	return prob_zero_state-prob_one_state

def expectation_z(state):
	state_z=state
	prob_zero_state=(state_z.item(0)*state_z.item(0).conjugate()).real
	prob_one_state=(state_z.item(1)*state_z.item(1).conjugate()).real
	return prob_zero_state-prob_one_state

def get_target_value_cnot(two_qubit_state):
	"""just returns either a zero or one state equal to the target value of the CNOT output. 
	Throws exception if not a pure two qubit state"""
	if np.allclose(two_qubit_state,two_qubits_00) or np.allclose(two_qubit_state,two_qubits_10):
		return zero_state
	elif np.allclose(two_qubit_state,two_qubits_01) or np.allclose(two_qubit_state,two_qubits_11):
		return one_state
	else:
		raise ValueError('Input must be a pure two qubit state')

def measure(state):
	"""finally some probabilities, whee. To properly use, set the qubit you measure to the result of this function
		to collapse it. state=measure(state) """
	state_z=state
	prob_zero_state=(state_z.item(0)*state_z.item(0).conjugate()).real
	prob_one_state=(state_z.item(1)*state_z.item(1).conjugate()).real
	rand=random.random()
	if rand<prob_zero_state:
		return zero_state
	if rand==prob_zero_state:
		return random.choice([zero_state,one_state])
	else:
		return one_state
		


def get_bloch(state):
	return np.array((expectation_x(state),expectation_y(state),expectation_z(state)))

def get_bloch_2(state):
	""" equal to get_bloch just a different way of calculating things. Used for testing get_bloch. """
	return np.array((((state*state.conjugate().transpose()*X).trace()).item(0),((state*state.conjugate().transpose()*Y).trace()).item(0),((state*state.conjugate().transpose()*Z).trace()).item(0)))

class QuantumComputer(object):
	"""This class is meant to simulate the 5-qubit IBM quantum computer, 
		and be able to interpret the auto generated programs on the site."""
	def __init__(self):
		self.q0=zero_state
		self.q1=zero_state
		self.q2=zero_state
		self.q3=zero_state
		self.q4=zero_state
	def execute(self,program):
		"""Time for some very lazy meta programming!
		"""
		# Transforming IBM's language to my variables
		lines=program.split(';')
		translation=[
			['q[0]','self.q0'],
			['q[1]','self.q1'],
			['q[2]','self.q2'],
			['q[3]','self.q3'],
			['q[4]','self.q4'],
			['bloch self.q0',r'get_bloch(self.q0)'],
			['bloch self.q1',r'get_bloch(self.q1)'],
			['bloch self.q2',r'get_bloch(self.q2)'],
			['bloch self.q3',r'get_bloch(self.q3)'],
			['bloch self.q4',r'get_bloch(self.q4)'],
			['measure self.q0',r'measure(self.q0)'],
			['measure self.q1',r'measure(self.q1)'],
			['measure self.q2',r'measure(self.q2)'],
			['measure self.q3',r'measure(self.q3)'],
			['measure self.q4',r'measure(self.q4)'],
			['id',''],
			['sdg ','Sdagger*'],
			['tdg ','Tdagger*'],
			['h ','H*'],
			['t ','T*'],
			['s ','S*'],
			['x ','X*'],
			['y ','Y*'],
			['z ','Z*'],
			]
		qubit_mod_re=re.compile(' q\[[0-4]\]$')
		cnot_re=re.compile('^(q\[[0-4]\]=)cx (q\[[0-4]\]), (q\[[0-4]\])$')
		for l in lines:
			l=l.strip()
			if not l: continue
			# This sets the value of the qubit to the line
			mod=qubit_mod_re.findall(l)
			if mod:
				l=mod[0].strip()+'='+l
			# CNOT operates on two qubits so gets special processing
			cnot=cnot_re.match(l)
			if cnot:
				set_syntax=cnot.group(1)
				control_qubit=cnot.group(2)
				target_qubit=cnot.group(3)
				l='%sget_target_value_cnot(CNOT*(%s*%s.conjugate().transpose()).reshape(4,1))'%(set_syntax,control_qubit,target_qubit)
			for k,v in translation:
				l=l.replace(k,v)
			# Now running the code
			exec l

class TestMeasure(unittest.TestCase):
	def test_measure_probs_plus(self):
		measurements=[]
		for i in range(100000):
		 	measurements+=[measure(plus_state)]
		result=(1.*sum(measurements))/len(measurements)
		self.assertAlmostEqual(result.item(0),0.5,places=2)
		self.assertAlmostEqual(result.item(1),0.5,places=2)
	def test_measure_probs_minus(self):
		measurements=[]
		for i in range(100000):
		 	measurements+=[measure(minus_state)]
		result=(1.*sum(measurements))/len(measurements)
		self.assertAlmostEqual(result.item(0),0.5,places=2)
		self.assertAlmostEqual(result.item(1),0.5,places=2)
	def test_collapse(self):
		result=None
		for i in range(100):
			if result==None:
				result=measure(minus_state)
			else:
				new_measure=measure(result)
				self.assertTrue(np.allclose(result,new_measure))
				result=new_measure				

class TestGetBloch(unittest.TestCase):
	def test_get_bloch(self):
		self.assertTrue(np.allclose(get_bloch(zero_state),np.array((0,0,1))))
		self.assertTrue(np.allclose(get_bloch(one_state),np.array((0,0,-1))))
		self.assertTrue(np.allclose(get_bloch(plusi_state),np.array((0,1,0))))
		self.assertTrue(np.allclose(get_bloch(minusi_state),np.array((0,-1,0))))
		self.assertTrue(np.allclose(get_bloch(Z*plus_state),np.array((-1,0,0))))
		self.assertTrue(np.allclose(get_bloch(Z*minus_state),np.array((1,0,0))))

		# assert the norms are 1 for cardinal points (obviously) but also for a few other points at higher T depth on the Bloch Sphere
		for state in [zero_state,one_state,plusi_state,minusi_state,Z*plus_state,H*T*Z*plus_state,H*T*H*T*H*T*Z*plus_state]:
			self.assertAlmostEqual(np.linalg.norm(get_bloch(state)),1.0)

class TestGetBloch2(unittest.TestCase):
	def test_get_bloch_2(self):
		self.assertTrue(np.allclose(get_bloch_2(zero_state),get_bloch(zero_state)))
		self.assertTrue(np.allclose(get_bloch_2(one_state),get_bloch(one_state)))
		self.assertTrue(np.allclose(get_bloch_2(plusi_state),get_bloch(plusi_state)))
		self.assertTrue(np.allclose(get_bloch_2(minusi_state),get_bloch(minusi_state)))
		self.assertTrue(np.allclose(get_bloch_2(Z*plus_state),get_bloch(Z*plus_state)))
		self.assertTrue(np.allclose(get_bloch_2(H*T*Z*plus_state),get_bloch(H*T*Z*plus_state))) # test for arbitrary gates

class TestTwoQubits(unittest.TestCase):
	def test_twoqubits(self):
		self.assertTrue(np.allclose(two_qubits_00,(zero_state*zero_state.conjugate().transpose()).reshape(4,1)))
		self.assertTrue(np.allclose(two_qubits_01,(zero_state*one_state.conjugate().transpose()).reshape(4,1)))
		self.assertTrue(np.allclose(two_qubits_10,(one_state*zero_state.conjugate().transpose()).reshape(4,1)))
		self.assertTrue(np.allclose(two_qubits_11,(one_state*one_state.conjugate().transpose()).reshape(4,1)))

class TestCNOTGate(unittest.TestCase):	
	def test_CNOT(self):
		self.assertTrue(np.allclose(CNOT*two_qubits_00,two_qubits_00))
		self.assertTrue(np.allclose(CNOT*two_qubits_01,two_qubits_01))
		self.assertTrue(np.allclose(CNOT*two_qubits_10,two_qubits_11))
		self.assertTrue(np.allclose(CNOT*two_qubits_11,two_qubits_10))

class TestTGate(unittest.TestCase):
	def test_T(self):
		# This is useful to check some of the exercises on IBM's quantum experience. 
		# "Ground truth" answers from IBM's calculations which unfortunately are not reported to high precision.
		red_state=S*T*H*T*H*zero_state
		green_state=S*H*T*H*T*H*T*H*S*T*H*T*H*zero_state
		blue_state=H*S*T*H*T*H*S*T*H*T*H*T*H*zero_state
		self.assertTrue(np.allclose(get_bloch(red_state),np.array((0.5,0.5,0.707)),rtol=1e-3))
		self.assertTrue(np.allclose(get_bloch(green_state),np.array((0.427,0.457,0.780)),rtol=1e-3))
		self.assertTrue(np.allclose(get_bloch(blue_state),np.array((0.457,0.427,0.780)),rtol=1e-3))
		# Checking norms
		for state in [red_state,green_state,blue_state]:
			self.assertAlmostEqual(np.linalg.norm(get_bloch(state)),1.0)

class TestQuantumComputer(unittest.TestCase):
	def setUp(self):
		self.qc=QuantumComputer()
	def test_execute_bluestate(self):
		"""Tests h,t,s,and bloch syntax on one qubit"""
		# This is a program to generate the 'blue state' in IBM's exercise
		program_blue_state="""h q[1];
			t q[1];
			h q[1];
			t q[1];
			h q[1];
			t q[1];
			s q[1];
			h q[1];
			t q[1];
			h q[1];
			t q[1];
			s q[1];
			h q[1];
			bloch q[1];"""
		self.qc.execute(program_blue_state)
		# check if we are in the blue state
		blue_state=H*S*T*H*T*H*S*T*H*T*H*T*H*zero_state
		self.assertTrue(np.allclose(get_bloch(blue_state),self.qc.q1))
		# check to make sure we didn't change any other qubits in the QC
		for unchanged_state in [self.qc.q0,self.qc.q2,self.qc.q3,self.qc.q4]:
			self.assertTrue(np.allclose(unchanged_state,zero_state))
	def test_execute_X_Y_Z_Measure_Id_Sdag_Tdag(self):
		"""Tests z,y,measure,id,sdag,tdag syntax on all 5 qubits"""
		program_test_many="""sdg q[0];
			x q[1];
			x q[2];
			id q[3];
			z q[4];
			tdg q[0];
			y q[4];
			measure q[0];
			measure q[1];
			measure q[2];
			measure q[3];
			measure q[4];"""
		self.qc.execute(program_test_many)
		# result should be 01101
		self.assertTrue(np.allclose(self.qc.q0,zero_state))
		self.assertTrue(np.allclose(self.qc.q1,one_state))
		self.assertTrue(np.allclose(self.qc.q2,one_state))
		self.assertTrue(np.allclose(self.qc.q3,zero_state))
		self.assertTrue(np.allclose(self.qc.q4,one_state))

	def test_execute_cnot(self):
		"""Tests cnot"""
		program_test_cnot="""x q[1];
			cx q[1], q[2];"""
		self.qc.execute(program_test_cnot)
		# result should be 01100
		self.assertTrue(np.allclose(self.qc.q0,zero_state))
		self.assertTrue(np.allclose(self.qc.q1,one_state))
		self.assertTrue(np.allclose(self.qc.q2,one_state))
		self.assertTrue(np.allclose(self.qc.q3,zero_state))
		self.assertTrue(np.allclose(self.qc.q4,zero_state))

	def test_execute_many(self):
		"""Tests z,y,cnot,measure,id,sdag,tdag syntax on all 5 qubits"""
		program_test_many="""sdg q[0];
			x q[1];
			x q[2];
			id q[3];
			z q[4];
			tdg q[0];
			cx q[1], q[2];
			y q[4];
			measure q[0];
			measure q[1];
			measure q[2];
			measure q[3];
			measure q[4];"""
		self.qc.execute(program_test_many)
		# result should be 01001
		self.assertTrue(np.allclose(self.qc.q0,zero_state))
		self.assertTrue(np.allclose(self.qc.q1,one_state))
		self.assertTrue(np.allclose(self.qc.q2,zero_state))
		self.assertTrue(np.allclose(self.qc.q3,zero_state))
		self.assertTrue(np.allclose(self.qc.q4,one_state))

	def tearDown(self):
		self.qc=None


if __name__ == '__main__':
 	unittest.main()
